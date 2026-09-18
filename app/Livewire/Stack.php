<?php

namespace App\Livewire;

use Livewire\Component;

class Stack extends Component
{
    public ?string $title = 'Stack';

    public function render()
    {
        return view('livewire.stack')
            ->title($this->title);
    }
}
