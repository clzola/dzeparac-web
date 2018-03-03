<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property string $photo_url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
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
