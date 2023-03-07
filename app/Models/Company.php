<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @mixin Builder
 *
 * Table columns:
 * @property int    $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relations:
 *
 * Accessors:
 *
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 */
class Company extends Model
{
    use HasFactory;

    // Relationships

    /**
     * @return HasMany
     */
    public function projects() : HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * @return HasMany
     */
    public function employees() : HasMany
    {
        return $this->hasMany(Employee::class);
    }

    // Accessors
    public function getAuthorizationTokenAttribute() : string
    {
        return "c-".$this->id."-access-token";
    }
}
