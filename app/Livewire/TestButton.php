<?php

namespace App\Livewire;

use Livewire\Component;

class TestButton extends Component
{
    public $message = '';

    public function testClick()
    {
        $this->message = '¡Botón funcionando! ' . now()->format('H:i:s');
    }

    public function render()
    {
        return view('livewire.test-button');
    }
} 