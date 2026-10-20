<?php

namespace App\Livewire\Project;

use App\Enums\ProjectStatusEnum;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public string $roleId = '';

    public string $status = '';

    #[Locked]
    public array $columns = [
        'id',
        'title',
        'slug',
        'role_id',
        'excerpt',
        'body',
        'status',
        'is_published',
        'github_url',
        'live_url',
        'featured_image',
        'project_logo',
    ];

    #[Locked]
    public int $perPage = 10;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedRoleId(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function projectStatusCases(): array
    {
        return ProjectStatusEnum::cases();
    }

    #[Computed]
    public function projects(): LengthAwarePaginator
    {
        return Project::query()
            ->with([
                'role' => fn($query) => $query->select('id', 'title'),
                'skills' => fn($query) => $query->select('skills.id', 'skills.name')
            ])
            ->when($this->search, fn($query) => $query->where('title', 'like', "%{$this->search}%"))
            ->when($this->roleId, fn($query) => $query->where('role_id', $this->roleId))
            ->when($this->status, fn($query) => $query->where('status', $this->status))
            ->select($this->columns)
            ->latest()
            ->paginate($this->perPage);
    }

    #[Computed]
    public function roles(): Collection
    {
        return Role::query()
            ->orderBy('title')
            ->get(['id', 'title']);
    }

    public function render()
    {
        return view('livewire.project.project-index')
            ->title('Projects');
    }
}
