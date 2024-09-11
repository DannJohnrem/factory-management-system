<?php

namespace App\Models;

use App\Traits\LogsModelChanges;
use App\Services\ModelEventService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factories extends Model
{
    use HasFactory, SoftDeletes, LogsModelChanges;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'factory_name',
        'location',
        'email',
        'website',
    ];

    /**
     * Get the employees for the factory.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
