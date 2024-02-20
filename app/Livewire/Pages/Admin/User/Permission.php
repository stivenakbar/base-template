<?php

namespace App\Livewire\Pages\Admin\User;

use App\Models\AccessModel;
use App\Models\MenusModel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Permission extends Component
{
    #[Title('Permission')]
    #[Url(as : 'q')]
    public $role;

    public $acces = [];

    public function mount()
    {
        $permissions = Role::findByName($this->role)->permissions->pluck('name')->toArray();
        foreach ($permissions as $permission) {
            $this->acces[$permission] = true;
        }
        // dd($this->acces);
    }

    public function render()
    {
        $menus = MenusModel::where('role',$this->role)->orWhere('role','all')->get();
        $role = Role::findByName($this->role);
        $permissions = $role->permissions->pluck('name')->toArray();
        return view('livewire.pages.admin.user.permission',[
            'menus' => $menus,
            'permissions' => $permissions,
            'access' => AccessModel::all()
        ]);
    
    }

    public function save()
    {
        $role = Role::findByName($this->role);
        $role->syncPermissions(array_keys(array_filter($this->acces)));
        $this->dispatch("save");
    }
}
