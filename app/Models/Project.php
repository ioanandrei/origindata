<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin Builder
 *
 * Table columns:
 * @property int    $id
 * @property string $name
 * @property int    $company_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relations:
 *
 * Accessors:
 *
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 */
class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relationships

    /**
     * @return BelongsTo
     */
    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return BelongsToMany
     */
    public function employees() : BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
