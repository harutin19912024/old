<?php

namespace App\Common;

use Illuminate\Support\Env;

class EnvironmentBootstrapper
{
    public function bootstrap(): void
    {
        $request = request();

        if ($request && $request->is('__cypress__/artisan')) {
            Env::getRepository()->set('APP_RUNNING_IN_CONSOLE', 'true');
        }
    }
}
