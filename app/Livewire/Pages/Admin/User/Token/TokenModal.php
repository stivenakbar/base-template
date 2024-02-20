<?php

namespace App\Livewire\Pages\Admin\User\Token;

use App\Models\RolesModel;
use App\Models\User;
use Livewire\Component;
use App\Models\AccessModel;
use Livewire\Attributes\On;
use App\Models\PersonalTokenModel;
use Illuminate\Support\Facades\Auth;

class TokenModal extends Component
{
    public $role_id;
    public $name;
    public $expires_at;
    public $id;
    public $selectAll = false;
    public $selectAllEdit = false;
    public $abilities = [];
    public $selectedAbilities = [];
    public $selectedAbilitiesEdit = [];


    public function mount()
    {
        $tables = \DB::select('SHOW TABLES');
        $this->abilities = array_map(function ($table) {
            return current((array) $table);
        }, $tables);
    }

    public function updatedSelectAll($value)
    {
        $actions = ['select', 'insert', 'update', 'delete'];
        foreach ($this->abilities as $ability) {
            foreach ($actions as $action) {
                $this->selectedAbilities[$ability . '-' . $action] = $value;
            }
        }
    }

    public function updatedSelectAllEdit($value)
    {
        $actions = ['select', 'insert', 'update', 'delete'];
        foreach ($this->abilities as $ability) {
            foreach ($actions as $action) {
                $this->selectedAbilitiesEdit[$ability . '-' . $action] = $value;
            }
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.user.token.token-modal', [
            'roles' => RolesModel::all(),
        ]);
    }

    #[On("reset")]
    public function resetForm()
    {
        $this->name = '';
        $this->role_id = null;
        $this->expires_at = null;
        $this->selectedAbilities = [];
        $this->selectedAbilitiesEdit = [];
        $this->selectAll = false;
        $this->selectAllEdit = false;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store()
    {
        $validated =  $this->validate([
            'role_id' => 'required',
            'name' => 'required|min:4|max:255',
            'selectedAbilities' => 'required',
            'expires_at' => 'date|nullable',
        ]);

        $role = RolesModel::find($validated['role_id']);
        $filteredAbilities = array_keys(array_filter($validated['selectedAbilities']));
        $filteredAbilitiesValue = array_values($filteredAbilities);
        $abilitiesCount = count($this->abilities) * 4;

        // Add select * if selectAll true
        if ($this->selectAll || count($filteredAbilitiesValue) == $abilitiesCount) {
            $filteredAbilitiesValue[] = '*';
        }

        // If filtered less than all abilities remove *
        if (count($filteredAbilitiesValue) < $abilitiesCount) {
            $filteredAbilitiesValue = array_filter($filteredAbilitiesValue, function($value) {
                return $value !== '*';
            });
            
            // Re-index the array
            $filteredAbilitiesValue = array_values($filteredAbilitiesValue);
        }

        // Check if a token already exists for the role
        $token = PersonalTokenModel::where('tokenable_id', $role->id)->first();

        if ($token) {
            // Update the existing token
            $token->update([
                'name' => $validated['name'],
                'abilities' => $filteredAbilitiesValue,
                'expires_at' => $validated['expires_at'],
            ]);
        } else {
            // Create a new token
            $role->createTokenWithPlainText($validated['name'], $filteredAbilitiesValue, $validated['expires_at']);
        }

        if ($token) {
            $this->dispatch('token-added');
            $this->dispatch("swal", [
                'livewire_intance' => $this->getId(),
                'type' => "success",
                'text' => 'Token Added Successfully',
            ]);
            $this->resetForm();
        }
    }

    #[On('edit')]
    public function edit($id)
    {
        $token = PersonalTokenModel::find($id);
        $role = RolesModel::find($token->tokenable_id);
        $this->name = $token->name;
        $this->role_id = $role->name;
        $this->expires_at = $token->expires_at;
        $this->selectedAbilitiesEdit = array_fill_keys($token->abilities, true);

        if (in_array('*', $token->abilities)) {
            $this->selectAllEdit = true;
        }

        $this->id = $token->id;
        $this->dispatch('token-edit');
    }

    public function update()
    {
        $validated =  $this->validate([
            'role_id' => 'required',
            'name' => 'required|min:4|max:255',
            'selectedAbilitiesEdit' => 'required',
            'expires_at' => 'date|nullable',
        ]);

        $personalToken = PersonalTokenModel::find($this->id);
        $filteredAbilities = array_keys(array_filter($validated['selectedAbilitiesEdit']));
        $filteredAbilitiesValue = array_values($filteredAbilities);

        $abilitiesCount = count($this->abilities) * 4;

        // Add select * if selectAll true
        if ($this->selectAllEdit || count($filteredAbilitiesValue) == $abilitiesCount) {
            $filteredAbilitiesValue[] = '*';
        }

        if (count($filteredAbilitiesValue) < $abilitiesCount) {
            $filteredAbilitiesValue = array_filter($filteredAbilitiesValue, function($value) {
                return $value !== '*';
            });
            
            // Re-index the array
            $filteredAbilitiesValue = array_values($filteredAbilitiesValue);
        }

        $personalToken->update([
            'name' => $this->name,
            'abilities' => $filteredAbilitiesValue,
            'expires_at' => $this->expires_at,
        ]);

        if ($personalToken) {
            $this->dispatch('token-updated');
            $this->dispatch("swal", [
                'livewire_intance' => $this->getId(),
                'type' => "success",
                'text' => 'Token Updated Successfully',
            ]);
            $this->resetForm();
        }
    }

    #[On('delete')]
    public function delete($id)
    {
        // If the user has more than one token with the ability to delete a token, just delete the token
        $personalToken = PersonalTokenModel::destroy($id);
        if ($personalToken) {
            $this->dispatch('token-deleted');
            $this->dispatch("swal", [
                'livewire_intance' => $this->getId(),
                'type' => "success",
                'text' => 'Token Deleted Successfully',
            ]);
            $this->resetForm();
        }
    }
}
