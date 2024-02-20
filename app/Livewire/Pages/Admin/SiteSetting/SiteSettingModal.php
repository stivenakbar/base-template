<?php

namespace App\Livewire\Pages\Admin\SiteSetting;

use App\Models\SiteSettingModel;
use Livewire\Attributes\On;
use Livewire\Component;

class SiteSettingModal extends Component
{
    public $name;
    public $value;
    public $description;

    public function render()
    {
        return view('livewire.pages.admin.site-setting.site-setting-modal');
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        SiteSettingModel::create([
            'name' => $this->name,
            'value' => $this->value,
            'description' => $this->description ,
        ]);

        $this->dispatch('site-added');
    }

    #[On('edit')]
    public function edit($id){
        
        $site = SiteSettingModel::find($id);
        $this->name = $site->name;
        $this->value = $site->value;
        $this->description = $site->description;
        if($site){
            $this->dispatch('site-edit');
        }
    }
}
