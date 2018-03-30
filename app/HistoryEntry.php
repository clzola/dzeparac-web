<?php

namespace Dzeparac;

use Illuminate\Database\Eloquent\Model;


/**
 * Dzeparac\HistoryEntry
 *
 * @property int $id
 * @property int $child_id
 * @property string|null $name
 * @property int $category_id
 * @property float $price
 * @property string|null $photo_filename
 * @property string|null $notes
 * @property int $wish_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $photo_url
 * @property-read \Dzeparac\Category|null $category
 * @property-read \Dzeparac\User $child
 * @property-read \Dzeparac\Wish|null $wish
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry whereChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\HistoryEntry whereWishId($value)
 * @mixin \Eloquent
 */
class HistoryEntry extends Model
{
	protected $table = 'history';
	protected $primaryKey = 'id';

	protected $fillable = [
		'category_id',
		'name',
		'price',
		'notes',
	];

	public $casts = [
	    'id' => 'integer',
		'child_id' => 'integer',
		'category_id' => 'integer',
		'wish_id' => 'integer',
		'price' => 'double',
	];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
	 */
	public function child()
	{
	    return $this->belongsTo(User::class, 'child_id');
	}
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Wish
	 */
	public function wish()
	{
	    return $this->belongsTo(Wish::class, 'wish_id');
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
		return "http://dzeparac.me/storage/history/images/{$this->photo_filename}";
	}
}
