<?php

namespace App\Livewire\Components\Atoms;

use Livewire\Component;

class Input extends Component
{
    public $class;
    public $type;
    public $name;
    public $placeholder;
    public $value;
    public $required; // true or false

    public function mount($required = false,$model='',$class = '', $type = 'text', $name = '', $placeholder = '', $value = '')
    {
        $this->class = $class;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;
    }

    public function render()
    {
        return view('livewire.components.atoms.input');
    }
}
