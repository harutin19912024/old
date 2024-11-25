<?php

namespace App\Traits;

use App\Adjustments\Adjusters\Addon;
use App\Adjustments\Adjusters\FixedDiscount;
use App\Adjustments\Adjusters\PercentageDiscount;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Vanilo\Adjustments\Models\Adjustment;

trait AdjustmentsByType
{
    public function adjustmentsByType(array|string $type): Collection
    {
        $arr = is_string($type) ? [$type] : $type;
        return $this->adjustmentsRelation()->whereIn('adjuster', $arr)->get();
    }

    public function getDiscountAdjustments(): Collection
    {
        return $this->adjustmentsByType([FixedDiscount::class, PercentageDiscount::class]);
    }

    public function getAddonAdjustments(): Collection
    {
        return $this->adjustmentsByType([Addon::class]);
    }

    public function getTotalFromCollection(Collection $collection): float
    {
        return floatval($collection->sum('amount'));
    }

    public function deleteAdjustmentsByType(array $types): void
    {
        $adjustments = $this->adjustmentsByType($types);
        $adjustments->each(fn(Adjustment $adjustment) => $adjustment->delete());
    }
}
