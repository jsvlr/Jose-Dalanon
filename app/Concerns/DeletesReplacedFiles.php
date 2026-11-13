<?php

namespace App\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Outerweb\Settings\Facades\Setting;

trait DeletesReplacedFiles
{
    protected function getFileFields(): array
    {
        return [];
    }

    protected function getFileDisk(): string
    {
        return 'public';
    }

    public function save(): void
    {
        $fields = $this->getFileFields();

        $old = collect($fields)->mapWithKeys(fn(string $key) => [$key => Arr::wrap(Setting::get($key))]);

        parent::save();
        foreach ($fields as $key) {
            $removed = array_diff($old[$key], Arr::wrap(Setting::get($key)));

            foreach (array_filter($removed) as $path) {
                Storage::disk($this->getFileDisk())->delete($path);
            }
        }
    }

}
