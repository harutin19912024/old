<?php

namespace App\Traits;

use App\Models\Meta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait Metable
{
    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    /** @return \App\Models\Meta */
    public function addMeta(string $key, string|int|null $value): Model
    {
        return $this->meta()->updateOrCreate([
            'meta_key' => $key,
        ], [
            'meta_value' => $value,
        ]);
    }

    public function getMeta(string $key): ?string
    {
        return $this->meta()->where('meta_key', $key)->value('meta_value');
    }

    public function getFlatMeta(): Collection
    {
        return $this->mapIntoFlat($this->meta);
    }

    public function getMetaArrayStartingWith(string $prefix, bool $includePrefix = false): Collection
    {
        $meta = $this->mapIntoFlat($this->meta()->where('meta_key', 'like', $prefix . '%')->get());

        if (!$includePrefix) {
            $meta = $meta->mapWithKeys(function ($value, $key) use ($prefix) {
                return [
                    substr($key, strlen($prefix)) => $value,
                ];
            });
        }

        return $meta;
    }

    private function mapIntoFlat(Collection $metas): Collection
    {
        return $metas->mapWithKeys(function ($item) {
            return [$item['meta_key'] => $item['meta_value']];
        });
    }
}
