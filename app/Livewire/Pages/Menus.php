<?php

namespace App\Livewire\Pages;

use App\Models\MenusModel;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class Menus extends Component
{
    use WithPagination;

    public $name;
    public $url;
    public $module;
    public $order;
    public $icon;
    public $slug;
    public $parent_id;
    public $id;

    public function render()
    {
        return view('livewire.pages.menus',[
            'menus' => MenusModel::paginate(2),
            'parents' => MenusModel::where('parent_id', null)->get(),
        ]);
    }

    public function store(){
        $menus = MenusModel::create([
            'name' => $this->name,
            'url' => $this->url,
            'module' => $this->module,
            'order' => $this->order,
            'icon' => $this->icon,
            'slug' => $this->slug,
            'parent_id' => $this->parent_id,
        ]);

        $this->dispatch('menu-added');
        back();
    }

    public function delete($id){
        MenusModel::find($id)->delete();
        back();
    }

    public function show($id){
        $this->id = $id;
        $menus = MenusModel::find($id);
        $this->name = $menus->name;
        $this->url = $menus->url;
        $this->module = $menus->module;
        $this->order = $menus->order;
        $this->icon = $menus->icon;
        $this->slug = $menus->slug;
        $this->dispatch('show-menu');
    }

    public function update(){
        $id = $this->id;
        $menus = MenusModel::find($id);
        $menus->update([
            'name' => $this->name,
            'url' => $this->url,
            'module' => $this->module,
            'order' => $this->order,
            'icon' => $this->icon,
            'slug' => $this->slug,
        ]);
        $this->dispatch('menu-updated');
        back();
    }

}
