<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;


/**
 * App\Parentt
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Child[] $children
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Parentt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Parentt whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Parentt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Parentt wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Parentt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Parentt whereUsername($value)
 * @mixin \Eloquent
 */
class Parentt extends User
{
	protected $table = 'parents';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public $casts = [
	    'id' => 'integer',
	];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|Child[]
     */
    public function children()
    {
        return $this->hasMany(Child::class, 'parent_id');
    }

	/**
	 * @return string
	 */
	public function getAuthIdentifierName()
	{
		return "username";
	}
}
