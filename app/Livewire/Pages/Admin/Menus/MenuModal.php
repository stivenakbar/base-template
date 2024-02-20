<?php

namespace App\Livewire\Pages\Admin\Menus;

use App\Http\Controllers\AutoRouteController;
use App\Models\IconsModel;
use Livewire\Component;
use App\Models\MenusModel;
use App\Models\RolesModel;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule as ValidationRule;
use Spatie\Permission\Models\Permission;

class MenuModal extends Component
{

    #[Rule('required|min:3|max:255|unique:menus,name')]
    public $name = "";
    #[Rule('required|max:255|unique:menus,url')]
    public $url = "";
    #[Rule('required|max:255|unique:menus,module')]
    public $module = "";
    #[Rule('required|int')]
    public $order = "";
    #[Rule('required')]
    public $is_active = "1";
    #[Rule('nullable')]
    public $parent_id = null;
    #[Rule('required|max:255')]
    public $icon = "";
    #[Rule('required')]
    public $location = "" ;

    public $id;
    public $slug;
    public $role = "all";


    public function store(){        
        $validated = $this->validate();
        if (strpos($validated['url'], '/') === 0) {
            $url = substr($validated['url'], 1);
            $validated['slug'] = str_replace("/","-",$url);
        }else{
            $validated['slug'] = str_replace("/","-",$validated['url']);
        }

        $newMenu = MenusModel::create($validated);
        Permission::create(['name' => $newMenu->module,  'guard_name' => 'web']);
        if($newMenu){
            $this->dispatch("menu-added");
        }

        $rewriteRoute = new AutoRouteController();
        $rewriteRoute->rewriteRouteFile($newMenu->id);
    }
    
    #[On('delete')] 
    public function delete($id){
        $menu = MenusModel::find($id);
        Permission::destroy($menu->module);
        if($menu->delete()){
            $this->dispatch("menu-deleted");
        }
        
    }

    #[On('edit')]
    public function edit($id){
        $menu = MenusModel::find($id);
        $this->name = $menu->name;
        $this->url = $menu->url;
        $this->module = $menu->module;
        $this->order = $menu->order;
        $this->slug = $menu->slug;
        $this->is_active = $menu->is_active;
        $this->parent_id = $menu->parent_id;
        $this->icon = $menu->icon;
        $this->id = $menu->id;
        $this->role = $menu->role;
        $this->location = $menu->location;
        $this->dispatch("menu-edit");
    }

    public function update(){
        $validated = $this->validate([
            'name' => [
                'required',
                'min:3',
                'max:255',
                ValidationRule::unique('menus', 'name')->ignore($this->id),
            ],
            'url' => [
                'required',
                'max:255',
                ValidationRule::unique('menus', 'url')->ignore($this->id),
            ],
            'module' => [
                'required',
                'max:255',
                ValidationRule::unique('menus', 'module')->ignore($this->id),
            ],
            'order' => 'required|int',
            
            'is_active' => 'required',
            'parent_id' => 'nullable',
            'icon' => 'required|max:255',
            'location' => 'required',
            'role' => 'required'
        ]);
        
        if(MenusModel::find($this->id)->update($validated)){
            $this->reset();
            $this->dispatch("menu-updated");
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.menus.menu-modal',
        [
            'parents' => MenusModel::all(),
            'icons' => IconsModel::all(),
            'roles' => RolesModel::all()
        ]);
    }

    
}
