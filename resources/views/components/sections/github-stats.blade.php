@props(['stats'])

@php
    $levelClasses = [
        0 => 'bg-gray-100 dark:bg-gray-800',
        1 => 'bg-green-200 dark:bg-green-900',
        2 => 'bg-green-300 dark:bg-green-700',
        3 => 'bg-green-500 dark:bg-green-600',
        4 => 'bg-green-700 dark:bg-green-400',
    ];
@endphp

<div {{ $attributes }}>
    <div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <div class="rounded-2xl bg-gray-50 p-5 dark:bg-gray-900">
            <p class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ number_format($stats['total_contributions']) }}
            </p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Contributions this year</p>
        </div>

        <div class="rounded-2xl bg-gray-50 p-5 dark:bg-gray-900">
            <p class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $stats['public_repos'] }}
            </p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Public repositories</p>
        </div>

        <div class="rounded-2xl bg-gray-50 p-5 dark:bg-gray-900">
            <p class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $stats['total_stars'] }}
            </p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Stars earned</p>
        </div>

        <div class="rounded-2xl bg-gray-50 p-5 dark:bg-gray-900">
            <p class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $stats['followers'] }}
            </p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">GitHub followers</p>
        </div>

        <div class="col-span-full rounded-2xl p-5">
            <p class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-200">Contribution activity</p>
            <div class="flex gap-1 overflow-x-auto pb-1 justify-center">
                @foreach ($stats['weeks'] as $week)
                    <div class="flex flex-col gap-1">
                        @foreach ($week['contributionDays'] as $day)
                            <span class="h-2.5 w-2.5 rounded-sm {{ $levelClasses[$day['level']] }}"
                                title="{{ $day['count'] }} contributions on {{ $day['date'] }}"></span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
