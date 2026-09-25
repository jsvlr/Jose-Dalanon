@props(['certificates'])

<div {{ $attributes }}>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="inline text-2xl font-bold">03</h1>
            <small class="opacity-50">Cerficates</small>
        </div>
    </div>

    <div class="grid grid-cols-2 grid-rows-2 gap-2 mt-5">
        @foreach ($certificates as $certificate)
            <a href="{{ $certificate->credential_url }}" target="_blank"
                class="bg-gray-50 dark:bg-gray-900 p-3 rounded-xl overflow-hidden hover:shadow-md transition-shadow duration-200 "
                title="{{ $certificate->title }}">
                <small class="p-3 rounded-md dark:bg-gray-950 w-auto font-bold">
                    General
                </small>
                <div class="mt-4 p-3">
                    <p class="text-xl">
                        {{ $certificate->title }}
                    </p>
                    <p>

                    </p>
                </div>
            </a>
        @endforeach
    </div>
</div>
