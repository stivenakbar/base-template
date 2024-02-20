<?php

namespace App\Livewire\Pages\Admin\SystemSetting;

use Livewire\Component;

class SystemSettingTableAction extends Component
{
    public  $systemSetting;
    public function mount($systemSetting){
        $this->systemSetting = $systemSetting;
    }
    public function render()
    {
        return view('livewire.pages.admin.system-setting.system-setting-table-action');
    }
}
