<?php

namespace App\Livewire;

use Livewire\Component;

class Homepage extends Component
{
    public int $count = 0;

    public function increment(): void
    {
        $this->count += 1;
    }

    public function decrement(): void
    {
        if ($this->count <= 0) return;
        $this->count -= 1;
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
