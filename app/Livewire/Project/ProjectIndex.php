<?php

namespace App\Livewire\Project;

use Livewire\Component;

class ProjectIndex extends Component
{
    public ?string $title = 'Projects';

    public function render()
    {
        return view('livewire.project.project-index')
            ->title($this->title);
    }
}
