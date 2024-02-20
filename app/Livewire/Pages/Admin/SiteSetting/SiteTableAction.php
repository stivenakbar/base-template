<?php

namespace App\Livewire\Pages\Admin\SiteSetting;

use Livewire\Component;

class SiteTableAction extends Component
{

    public $site;
    public function mount($site){
        $this->site = $site;
    }
    public function render()
    {
        return view('livewire.pages.admin.site-setting.site-table-action');
    }
}
