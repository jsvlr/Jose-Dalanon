<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public ?string $title = 'About';

    public function render()
    {
        return view('livewire.about')
            ->title($this->title);
    }
}
