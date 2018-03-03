<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;


/**
 * App\Child
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $code
 * @property string $photo_url
 * @property float $money
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HistoryEntry[] $historyEntries
 * @property-read \App\Parentt $parentt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Wish[] $wishes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Child whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Child whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Child whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Child whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Child whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Child whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Child wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Child whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Child extends User
{
	protected $table = 'children';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public $casts = [
	    'id' => 'integer',
	    'parent_id' => 'integer',
		'money' => 'double',
	];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Parentt
     */
    public function parentt()
    {
        return $this->belongsTo(Parentt::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|Wish[]
     */
    public function wishes()
    {
        return $this->hasMany(Wish::class, 'child_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|HistoryEntry[]
     */
    public function historyEntries()
    {
        return $this->hasMany(HistoryEntry::class, 'child_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection|Task[]
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'child_id');
    }
}
