<?php

namespace App\Filament\Widgets;

use App\Common\Search\ScoutHelper;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;

class TroubleshootingWidget extends Widget
{
    protected static string $view = 'filament.widgets.troubleshooting-widget';

    protected int|string|array $columnSpan = 2;

    public function reindex(): void
    {
        app(ScoutHelper::class)->reindex();
        Notification::make()->title('Reindexed')->success()->send();
    }

    public function deleteAllIndexes(): void
    {
        app(ScoutHelper::class)->deleteAllIndexes();
        Notification::make()->title('Deleted all indexes')->success()->send();
    }
}
