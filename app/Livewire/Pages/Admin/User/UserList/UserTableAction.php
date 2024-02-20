<?php

namespace App\Livewire\Pages\Admin\User\UserList;

use Livewire\Component;

class UserTableAction extends Component
{

    public $user;
    public function mount($user){
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.pages.admin.user.user-list.user-table-action');
    }
}
