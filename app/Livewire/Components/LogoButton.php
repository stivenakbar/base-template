<?php

namespace App\Livewire\Components;

use Livewire\Component;

class LogoButton extends Component
{

    public $text; // text on button
    public $logo; // path to logo
    public $iconPosition; // left or right
    public $disabled; // true or false
    public $href; //link action

    public function mount($href = '#',$text = 'Button', $logo = '', $iconPosition = 'left', $disabled = false)
    {
        $this->text = $text;
        $this->logo = $logo;
        $this->iconPosition = $iconPosition;
        $this->disabled = $disabled;
        $this->href = $href;

    }

    public function render()
    {
        return view('livewire.components.logo-button',[
            'text' => $this->text,
            'logo' => $this->logo,
            'iconPosition' => $this->iconPosition,
            'disabled' => $this->disabled,
        ]);
    }
}
