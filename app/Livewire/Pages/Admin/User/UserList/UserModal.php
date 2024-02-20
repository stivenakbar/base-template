<?php

namespace App\Livewire\Pages\Admin\User\UserList;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserModal extends Component
{
    public $name;
    public $email;
    public $role;
    public $password;
    public $id;

    public function render()
    {
        return view('livewire.pages.admin.user.user-list.user-modal',[
            'roles' => Role::all()
        ]);
    }

    public function store(){
       $validated =  $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $user->assignRole($this->role);
        if($user){
            $this->dispatch('user-added');
            // $this->reset();
        }
    }

    #[On('edit')]
    public function edit($id){
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first();
        $this->id = $user->id;
        $this->dispatch('user-edit');
    }

    public function update(){
        $user = User::find($this->id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);
        $user->syncRoles($this->role);
        if($user){
            $this->dispatch('user-updated');
            $this->reset();
        }
    }

    #[On('delete')]
    public function delete($id){
        $user = User::destroy($id);
        if($user){
            $this->dispatch('user-deleted');
        }
    }
}
