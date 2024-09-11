<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserActivityLogger
{
    /**
     * Log changes to a model.
     *
     * @param string $modelName
     * @param int $recordId
     * @param array|null $oldValues
     * @param array|null $newValues
     * @return void
     */
    public function logChange($modelName, $recordId, $oldValues = null, $newValues = null)
    {
        $userId = Auth::id();
        $logMessage = "Model: $modelName | Record ID: $recordId | User ID: $userId";

        if ($oldValues && $newValues) {
            $logMessage .= " | Old Values: " . json_encode($oldValues) . " | New Values: " . json_encode($newValues);
        }

        Log::info($logMessage);
    }
}
