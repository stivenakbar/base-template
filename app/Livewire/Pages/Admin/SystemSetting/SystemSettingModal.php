<?php

namespace App\Livewire\Pages\Admin\SystemSetting;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use App\Models\SystemSettingModel;
use Illuminate\Support\Facades\Auth;

class SystemSettingModal extends Component
{
    // #[Locked]
    public $id;
    
    public $name = "";
    public $value = "";
    public $description = "";
    public $is_active = '1';

    public function mount(){
        $this->dispatch("mount");
    }

    public function submit()
    {
        $validated = $this->validate([
            'name' => 'required|min:3|max:255|unique:system_settings,name',
            'value' => 'required|max:255',
            'description' => 'required|max:255',
            'is_active' => 'required'
        ]);
        if (SystemSettingModel::create($validated)) {
            $this->dispatch("system-setting-added");
            $this->dispatch("swal",[
                'livewire_intance' => $this->getId(),
                'type' => "success",
                'text' => 'System Setting Added Successfully',
            ]);
        }
    }
    #[On("edit")]
    public function edit($id){
        $systemSetting = SystemSettingModel::find($id);
        $this->id = $systemSetting->id;
        $this->name = $systemSetting->name;
        $this->value = $systemSetting->value;
        $this->description = $systemSetting->description;
        $this->is_active = $systemSetting->is_active;
        $this->dispatch("system-setting-edit");
    }

    public function update(){
        $validated = $this->validate([
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('system_settings', 'name')->ignore($this->id),
            ],
            'value' => 'required|max:255',
            'description' => 'required|max:255',
            'is_active' => 'required']);
        if (SystemSettingModel::find($this->id)->update($validated)) {
            $this->reset();
            $this->dispatch("system-setting-updated")->self();
        }
    }
    #[On("delete")]
    public function delete($id){
        if(SystemSettingModel::destroy($id)){
            $this->dispatch("system-setting-deleted")->self();
        };
    }
    #[On("reset")]
    public function resetForm(){
        $this->reset();
    }   

    public function render()
    {
        return view('livewire.pages.admin.system-setting.system-setting-modal');
    }
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
