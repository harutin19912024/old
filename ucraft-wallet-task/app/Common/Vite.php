<?php

namespace App\Common;

use Illuminate\Support\Str;
use RuntimeException;

class Vite
{
    public function resolvePath(string $entrypoint, string $buildDirectory = 'build', $relative = false): ?string
    {
        static $manifests = [];

        $buildDirectory = Str::start($buildDirectory, '/');
        $manifestPath = public_path($buildDirectory . '/manifest.json');

        if (!isset($manifests[$manifestPath])) {
            if (!is_file($manifestPath)) {
                if ($buildDirectory === '/build-admin') {
                    throw new RuntimeException('If you are accessing /admin/, run `npm run build-admin` first and then reload this page.');
                }

                return null;
            }

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];
        $path = $manifest[$entrypoint]['file'];

        if ($relative) {
            return "$buildDirectory/$path";
        }

        return asset("{$buildDirectory}/{$path}");
    }
}
