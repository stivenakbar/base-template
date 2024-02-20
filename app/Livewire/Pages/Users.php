<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        return view('livewire.pages.users',[
            'users' => User::paginate(10),
        ]);
    }
}
