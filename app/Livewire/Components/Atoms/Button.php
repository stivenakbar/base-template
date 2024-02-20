<?php

namespace App\Livewire\Components\Atoms;

use Livewire\Component;

class Button extends Component
{
    

    public $type;
    public $class;
    public $text;
    public $icon;
    public $iconPosition;
    public $disabled;
    public $id;

    public function mount($type = 'button', $class = 'btn btn-primary', $text = 'Button', $icon = '', $iconPosition = 'left', $disabled = false, $id = '')
    {
        $this->type = $type;
        $this->class = $class;
        $this->text = $text;
        $this->icon = $icon;
        $this->iconPosition = $iconPosition;
        $this->disabled = $disabled;
        $this->id = $id;
    }

    public function render()
    {
        return view('livewire.components.atoms.button', [
            'type' => $this->type,
            'class' => $this->class,
            'text' => $this->text,
            'icon' => $this->icon,
            'iconPosition' => $this->iconPosition,
            'disabled' => $this->disabled,
            'id' => $this->id,
        ]);
    }
}
