<?php

namespace App\Livewire\Pages\Admin\User\GenerateApi;

use Livewire\Component;
use App\Models\TablesNameModel;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\On;

class ApiTableAction extends Component
{
    public $table;
    public function mount($table)
    {
        $this->table = $table;
    }

    public function render()
    {
        return view('livewire.pages.admin.user.generate-api.api-table-action');
    }
}
