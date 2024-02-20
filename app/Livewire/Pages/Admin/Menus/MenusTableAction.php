<?php

namespace App\Livewire\Pages\Admin\Menus;

use Livewire\Component;

class MenusTableAction extends Component
{
    public $menus;
    public function mount($menus){
        $this->menus = $menus;
    }
    
    public function render()
    {
        return view('livewire.pages.admin.menus.menus-table-action');
    }
}
