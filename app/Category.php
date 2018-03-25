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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dzeparac\HistoryEntry[] $historyEntries
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dzeparac\Wish[] $wishes
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

	protected $fillable = [
		'name',
		'photo_url',
	];

	public $casts = [
	    'id' => 'integer',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|Wish[]|Wish
	 */
	public function wishes()
	{
	    return $this->hasMany(Wish::class, 'category_id');
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|HistoryEntry[]|HistoryEntry
	 */
	public function historyEntries()
	{
	    return $this->hasMany(HistoryEntry::class, 'category_id');
	}
}
