<?php

namespace Dzeparac;

use Illuminate\Database\Eloquent\Model;


/**
 * Dzeparac\Wish
 *
 * @property int $id
 * @property int $child_id
 * @property string $name
 * @property int $category_id
 * @property float $price
 * @property string $photo_url
 * @property string|null $notes
 * @property int $flag_fulfilled
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Dzeparac\Category $category
 * @property-read \Dzeparac\Child $child
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dzeparac\Task[] $tasks
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereFlagFulfilled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Wish extends Model
{
	protected $table = 'wishes';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public $casts = [
	    'id' => 'integer',
		'child_id' => 'integer',
		'category_id' => 'integer',
		'price' => 'double',
		'flag_fulfilled' => 'boolean'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Child
	 */
	public function child()
	{
	    return $this->belongsTo(Child::class, 'child_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|Task[]
	 */
	public function tasks()
	{
	    return $this->hasMany(Task::class, 'wish_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Category
	 */
	public function category()
	{
	    return $this->belongsTo(Category::class, 'category_id');
	}
}
