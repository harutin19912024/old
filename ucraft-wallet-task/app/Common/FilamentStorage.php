<?php

namespace App\Common;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

class FilamentStorage
{
    public function url(?string $path): ?string
    {
        if ($path === null) {
            return null;
        }

        return $this->disk()->url($path);
    }

    private function disk(): FilesystemAdapter
    {
        return Storage::disk(config('filament.default_filesystem_disk'));
    }
}
