<?php

namespace App\Common;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class ModelsHelper
{
    public function getMorphAlias(string $modelClass): ?string
    {
        $morphMap = Relation::morphMap();

        if (! empty($morphMap) && in_array($modelClass, $morphMap, true)) {
            return array_search($modelClass, $morphMap, true);
        }

        return null;
    }

    public function getCompositeId(Model $model): string
    {
        return $this->getMorphAlias($model::class) . '_' . $model->getId();
    }
}
