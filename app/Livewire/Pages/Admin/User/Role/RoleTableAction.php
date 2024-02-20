<?php

namespace App\Livewire\Pages\Admin\User\Role;

use Livewire\Component;

class RoleTableAction extends Component
{
    public $role;
    public function mount($role){
        $this->role = $role;
    }

    public function render()
    {
        return view('livewire.pages.admin.user.role.role-table-action');
    }
}
