<?php

namespace App\Livewire\Pages\Admin;

use App\Models\MenusModel;
use Livewire\Component;

class MenuSorting extends Component
{

    public $sidebarItem;
    public $topbarItem;

    public function mount()
    {
        $this->sidebarItem = MenusModel::where('parent_id',null)->where('location','sidebar')->orderBy("order","asc")->get();
        $this->topbarItem = MenusModel::where('parent_id',null)->where('location','topbar')->orderBy("order","asc")->get();
    }

    public function render()
    {
        return view('livewire.pages.admin.menu-sorting');
    }

    public function updateMenuOrder($list)
    {
        foreach ($list as $item) {
            MenusModel::find($item["value"])->update(["order" => $item["order"]]);
        }
        $this->dispatch('update');
    }
}
