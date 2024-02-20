<?php

namespace App\Livewire\Pages\Admin\User\Role;

use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleModal extends Component
{

    public $name;
    public $guard_name;

    public function render()
    {
        return view('livewire.pages.admin.user.role.role-modal');
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => 'required|min:3|max:255|unique:roles,name',
            'guard_name' => 'required|max:255|'
        ]);
        if (Role::create($validated)) {
            $this->dispatchBrowserEvent('role-added');
        }
    }

    #[On('edit')]
    public function edit($id)
    {
        $role = Role::find($id);
        $this->name = $role->name;
        $this->guard_name = $role->guard_name;
        $this->dispatch('role-edit');
    }
}
