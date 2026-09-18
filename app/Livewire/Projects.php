<?php

namespace App\Livewire;

use Livewire\Component;

class Projects extends Component
{
    public ?string $title = 'Projects';

    public function render()
    {
        return view('livewire.projects')
            ->title($this->title);
    }
}
