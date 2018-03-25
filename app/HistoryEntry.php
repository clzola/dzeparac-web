<?php

namespace Dzeparac;

use Illuminate\Database\Eloquent\Model;


/**
 * Dzeparac\HistoryEntry
 *
 * @property int $id
 * @property int $child_id
 * @property string|null $name
 * @property int|null $category_id
 * @property float $price
 * @property string|null $photo_url
 * @property string|null $notes
 * @property int|null $wish_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Dzeparac\Category|null $category
 * @property-read \Dzeparac\Child $child
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
	protected $guarded = [];

	public $casts = [
	    'id' => 'integer',
		'child_id' => 'integer',
		'category_id' => 'integer',
		'wish_id' => 'integer',
	];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Child
	 */
	public function child()
	{
	    return $this->belongsTo(Child::class, 'child_id');
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
}
