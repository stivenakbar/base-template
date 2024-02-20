<?php

namespace App\Livewire\Pages\Admin\User\Token;

use Livewire\Component;

class TokenTableAction extends Component
{
    public $personalToken;
    public function mount($personalToken){
        $this->personalToken = $personalToken;
    }
    public function render()
    {
        return view('livewire.pages.admin.user.token.token-table-action');
    }
}
