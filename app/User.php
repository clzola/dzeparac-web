<?php

namespace Dzeparac;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * Dzeparac\User
 *
 * @property int $id
 * @property bool $is_parent
 * @property bool $is_child
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property string|null $name
 * @property string|null $code
 * @property string|null $photo_filename
 * @property double|null $money
 * @property int $parent_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dzeparac\User[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dzeparac\HistoryEntry[] $historyEntries
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dzeparac\HistoryEntry[] $history_entries
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dzeparac\Wish[] $wishes
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereIsChild($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereIsParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
	    'email',
	    'name',
	    'code',
	    'photo_filename',
    ];

    protected $hidden = [
    	'is_parent',
	    'is_child',
        'password',
	    'remember_token',
    ];

    public $casts = [
        'id' => 'integer',
	    'is_child' => 'boolean',
	    'is_parent' => 'boolean',
	    'money' => 'double',
	    'parent_id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|User[]|User
     */
    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|Wish[]|Wish
     */
    public function wishes()
    {
        return $this->hasMany(Wish::class, 'child_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|HistoryEntry[]|HistoryEntry
     */
    public function historyEntries()
    {
        return $this->hasMany(HistoryEntry::class, 'child_id');
    }

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}

	/**
	 * @return string
	 */
	public function getPhotoUrlAttribute()
	{
		return "http://dzeparac.test/storage/children/images/{$this->photo_filename}";
	}
}
