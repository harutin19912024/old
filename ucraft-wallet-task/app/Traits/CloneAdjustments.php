<?php

namespace App\Traits;

trait CloneAdjustments
{
    public function cloneAdjustments(\ArrayAccess $adjustments): self
    {
        collect($adjustments)->each(fn($adjustment) => $this->adjustments()->create($adjustment->getAdjuster()));

        return $this;
    }
}
