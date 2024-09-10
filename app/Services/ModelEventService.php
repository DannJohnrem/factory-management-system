<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class ModelEventService
{
    public function logChanges($model, $oldValues = null, $newValues = null)
    {
        $modelName = get_class($model);
        $userId = auth()->id();
        $logMessage = "User ID: $userId, Model: $modelName, Changes: ";

        if ($oldValues) {
            $logMessage .= "Old: " . json_encode($oldValues) . ", ";
        }

        $logMessage .= "New: " . json_encode($newValues);
        Log::info($logMessage);
    }
}
