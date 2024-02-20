<?php

namespace App\Livewire\Components\Atoms;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public $files = [];

    public function render()
    {
        return view('livewire.components.atoms.file-upload');
    }
}
