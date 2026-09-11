@php
    $level = (float) $getState();
    $level = min(100, max(0, $level));

    [$color, $label] = match (true) {
        $level < 30 => ['bg-red-500', 'Beginner'],
        $level < 60 => ['bg-yellow-500', 'Intermediate'],
        $level < 80 => ['bg-blue-500', 'Advanced'],
        default => ['bg-green-500', 'Expert'],
    };

@endphp

<div class="flex items-center gap-3">
    <div class="w-20">
        <div class="h-2 w-full rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-2 rounded-full {{ $color }}" @style(['width' => $level . '%'])></div>
        </div>
    </div>

    <div class="flex min-w-24 flex-col">
        <span class="text-sm font-medium">
            {{ number_format($level, 2) }}%
        </span>

        <span class="text-xs text-gray-500 dark:text-gray-400">
            {{ $label }}
        </span>
    </div>
</div>
