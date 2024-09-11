<?php

namespace App\Traits;

use App\Services\UserActivityLogger;

trait LogsModelChanges
{
    protected static function bootLogsModelChanges()
    {
        static::created(function ($model) {
            app(UserActivityLogger::class)->logChange(get_class($model), $model->id);
        });

        static::updated(function ($model) {
            app(UserActivityLogger::class)->logChange(
                get_class($model),
                $model->id,
                $model->getOriginal(),
                $model->getChanges()
            );
        });

        static::deleted(function ($model) {
            app(UserActivityLogger::class)->logChange(get_class($model), $model->id);
        });
    }
}
