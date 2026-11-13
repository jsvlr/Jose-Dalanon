<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

trait DeletesFilesModelOnChange
{
    protected function getFileFields(): array
    {
        return [];
    }

    protected function getFileDisk(): string
    {
        return 'public';
    }

    public static function bootDeletesFilesOnModelChanged(): void
    {
        // After a successful update, delete files that were replaced or removed
        static::updated(function (Model $model) {
            foreach ($model->getFileFields() as $field) {
                if (!$model->wasChanged($field)) {
                    continue;
                }

                $old = Arr::wrap($model->getOriginal($field));
                $new = Arr::wrap($model->getAttribute($field));

                foreach (array_filter(array_diff($old, $new)) as $path) {
                    Storage::disk($model->getModelDisk())->delete($path);
                }
            }
        });

        // Clean up when the record itself is deleted
        static::deleted(function (Model $model) {
            // Skip soft deletes, the files may be needed on restore
            if (method_exists($model, 'isForcingDeleting') && !$model->isForcingDeleting()) {
                return;
            }

            foreach ($model->getFileFields() as $field) {
                foreach (array_filter(Arr::wrap($model->getAttribute($field))) as $path) {
                    Storage::disk($model->getFileDisk())->delete($path);
                }
            }
        });
    }
}
