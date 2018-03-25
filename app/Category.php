<?php

namespace Dzeparac;

use Illuminate\Database\Eloquent\Model;


/**
 * Dzeparac\Category
 *
 * @property int $id
 * @property string $name
 * @property string $photo_url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Category wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
	protected $table = 'categories';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public $casts = [
	    'id' => 'integer',
	];
}
