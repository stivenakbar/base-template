<?php

namespace App\Livewire\Pages\Admin\SiteSetting;

use Livewire\Attributes\Title;
use Livewire\Component;

class Page extends Component
{
    #[Title("Site Setting")]
    public function mount(){
        
    }

    public function render()
    {
        return view('livewire.pages.admin.site-setting.index');
    }
}
