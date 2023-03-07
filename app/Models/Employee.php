<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Contracts\AuthorizedEntity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin Builder
 *
 * Table columns:
 * @property int                      $id
 * @property string                   $email
 * @property Carbon                   $created_at
 * @property Carbon                   $updated_at
 *
 * Relations:
 * @property-read Company             $company
 * @property-read Collection<Project> $projects
 *
 * Accessors:
 * @property-read string              $authorizationTokenName
 *
 * @method static Builder|Employee newModelQuery()
 * @method static Builder|Employee newQuery()
 * @method static Builder|Employee query()
 */
class Employee extends Authenticatable implements AuthorizedEntity
{
    use HasApiTokens, HasFactory, Notifiable;

    // Variables
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
    public function projects() : BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    // Accessors

    /**
     * @return string
     */
    public function getAuthorizationTokenNameAttribute() : string
    {
        return "u-{$this->id}-token";
    }
}
