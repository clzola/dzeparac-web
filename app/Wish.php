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
 * @property string $photo_filename
 * @property string|null $notes
 * @property bool $is_fulfilled
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $photo_url
 * @property-read \Dzeparac\Category $category
 * @property-read \Dzeparac\User $child
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dzeparac\Task[] $tasks
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Wish whereIsFulfilled($value)
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

	protected $fillable = [
		'category_id',
		'name',
		'price',
		'notes'
	];

	public $casts = [
	    'id' => 'integer',
		'child_id' => 'integer',
		'category_id' => 'integer',
		'price' => 'double',
		'is_fulfilled' => 'boolean'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
	 */
	public function child()
	{
	    return $this->belongsTo(User::class, 'child_id');
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

	/**
	 * @return string
	 */
	public function getPhotoUrlAttribute()
	{
		return "http://dzeparac.me/storage/wishes/images/{$this->photo_filename}";
	}
}
