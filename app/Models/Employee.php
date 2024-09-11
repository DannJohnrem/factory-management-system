<?php

namespace App\Models;

use App\Traits\LogsModelChanges;
use App\Services\ModelEventService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes, LogsModelChanges;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'factory_id',
        'email',
        'phone',
    ];

    /**
     * Get the factory that owns the employee.
     */
    public function factory(): BelongsTo
    {
        return $this->belongsTo(Factories::class, 'factory_id', 'id');
    }
}
