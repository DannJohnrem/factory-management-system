<?php

namespace App\Services;

use App\Models\Factories;

class FactoryService
{
    public function createFactory($data)
    {
        return Factories::create($data);
    }

    public function updateFactory($factory, $data)
    {
        return $factory->update($data);
    }

    public function deleteFactory(Factories $factory)
    {
        try {
            $factory->delete();
            return response()->json(['message' => 'Factory deleted successfully'], 200);
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return response()->json(['message' => 'Failed to delete factory'], 500);
        }
    }

}
