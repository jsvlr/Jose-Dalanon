@props(['certificates'])

<section {{ $attributes }}>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Learning &
                growth</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">Certificates
            </h2>
        </div>
    </div>

    @if ($certificates->isEmpty())
        <div class="mt-6 rounded-2xl border border-dashed border-gray-300 px-6 py-10 text-center dark:border-gray-800">
            <p class="font-medium text-gray-700 dark:text-gray-300">Certificates will appear here soon.</p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">I’m always learning and expanding my toolkit.</p>
        </div>
    @else
        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            @foreach ($certificates as $certificate)
                <article wire:key="featured-certificate-{{ $loop->index }}"
                    class="flex min-w-0 items-start gap-4 rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-950 sm:p-6">
                    <span
                        class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-gray-100 text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                        @if ($certificate->image)
                            <img src="{{ Storage::url($certificate->image) }}"
                                alt="certificate-{{ $loop->index }} thumbnail" class="h-full w-full object-cover">
                        @else
                            <i class="fa-solid fa-award text-lg" aria-hidden="true"></i>
                        @endif
                    </span>

                    <div class="min-w-0 flex-1">
                        <h3 class="font-semibold leading-snug text-gray-950 dark:text-white">{{ $certificate->title }}
                        </h3>
                        @if ($certificate->issue_date)
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Issued {{ $certificate->issue_date->format('M Y') }}
                            </p>
                        @endif
                        @if ($certificate->credential_id)
                            <p class="mt-1 break-all text-xs text-gray-500 dark:text-gray-400">
                                Credential ID: {{ $certificate->credential_id }}
                            </p>
                        @endif
                        @if ($certificate->credential_url)
                            <a href="{{ $certificate->credential_url }}" target="_blank" rel="noopener noreferrer"
                                class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-gray-700 transition hover:text-gray-950 dark:text-gray-300 dark:hover:text-white">
                                View credential
                                <i class="fa-solid fa-arrow-up-right-from-square text-xs" aria-hidden="true"></i>
                            </a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
