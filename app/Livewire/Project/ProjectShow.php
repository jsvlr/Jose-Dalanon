<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ProjectShow extends Component
{

    #[Locked, Computed]
    public Project $project;

    #[Computed]
    public function content(): string
    {
        return RichContentRenderer::make($this->project->body)
            ->fileAttachmentsDisk('public')
            ->toHtml();
    }


    public function render()
    {
        return view('livewire.project.project-show')
            ->title($this->project->title);
    }
}
