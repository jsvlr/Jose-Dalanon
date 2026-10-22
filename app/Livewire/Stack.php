<?php

namespace App\Livewire;

use App\Models\Skill;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Stack extends Component
{
    public ?string $title = 'Stack';

    #[Computed]
    public function skillGroups(): Collection
    {
        return Skill::query()
            ->orderBy('name')
            ->get()
            ->sortBy(fn (Skill $skill): string => $skill->type->getLabel() ?? '')
            ->groupBy(fn (Skill $skill): string => $skill->type->getLabel() ?? 'Other');
    }

    public function render()
    {
        return view('livewire.stack')
            ->title($this->title);
    }
}
