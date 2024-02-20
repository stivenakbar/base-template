<?php

namespace App\Livewire\Components\Atoms;

use Livewire\Component;

class Separator extends Component
{
    public $text;
    public function mount(){
        $this->text = $this->text;
    }
    public function render()
    {
        return view('livewire.components.atoms.separator',[
            'text' => $this->text
        ]);
    }
}
