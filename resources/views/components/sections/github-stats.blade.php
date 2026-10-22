@props(['stats'])

@php
    $levelClasses = [
        0 => 'bg-gray-200 dark:bg-gray-800',
        1 => 'bg-emerald-200 dark:bg-emerald-900',
        2 => 'bg-emerald-300 dark:bg-emerald-700',
        3 => 'bg-emerald-500 dark:bg-emerald-600',
        4 => 'bg-emerald-700 dark:bg-emerald-400',
    ];
@endphp

<section {{ $attributes }}>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Open source</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">GitHub activity</h2>
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400">A little snapshot of what I’m building.</p>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-3 lg:grid-cols-4">
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-950">
            <p class="text-2xl font-bold tabular-nums text-gray-950 dark:text-white">{{ number_format($stats['total_contributions']) }}</p>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 sm:text-sm">Contributions this year</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-950">
            <p class="text-2xl font-bold tabular-nums text-gray-950 dark:text-white">{{ number_format($stats['public_repos']) }}</p>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 sm:text-sm">Public repositories</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-950">
            <p class="text-2xl font-bold tabular-nums text-gray-950 dark:text-white">{{ number_format($stats['total_stars']) }}</p>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 sm:text-sm">Stars earned</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-950">
            <p class="text-2xl font-bold tabular-nums text-gray-950 dark:text-white">{{ number_format($stats['followers']) }}</p>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 sm:text-sm">GitHub followers</p>
        </div>

        <div class="col-span-full rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-950 sm:p-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Contribution activity</h3>
                <div class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400" aria-label="Contribution intensity, low to high">
                    <span>Less</span>
                    @foreach ($levelClasses as $levelClass)
                        <span class="h-2.5 w-2.5 rounded-sm {{ $levelClass }}" aria-hidden="true"></span>
                    @endforeach
                    <span>More</span>
                </div>
            </div>

            @if (empty($stats['weeks']))
                <p class="mt-5 rounded-xl bg-gray-50 px-4 py-6 text-center text-sm text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                    Contribution activity is unavailable right now.
                </p>
            @else
                <div class="mt-5 overflow-x-auto pb-2">
                    <div class="flex min-w-max justify-center gap-1.5">
                        @foreach ($stats['weeks'] as $week)
                            <div class="flex flex-col gap-1.5">
                                @foreach ($week['contributionDays'] as $day)
                                    @php
                                        $level = $levelClasses[$day['level']] ?? $levelClasses[0];
                                    @endphp
                                    <span class="h-2.5 w-2.5 rounded-sm {{ $level }}"
                                        title="{{ $day['count'] }} contributions on {{ $day['date'] }}"
                                        aria-label="{{ $day['count'] }} contributions on {{ $day['date'] }}"></span>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
