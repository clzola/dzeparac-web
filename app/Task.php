<?php

namespace Dzeparac;

use Illuminate\Database\Eloquent\Model;


/**
 * Dzeparac\Task
 *
 * @property int $id
 * @property int $wish_id
 * @property int $child_id
 * @property string $name
 * @property boolean $child_completed
 * @property boolean $parent_completed
 * @property boolean $fulfilled
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Dzeparac\Child $child
 * @property-read \Dzeparac\Wish $wish
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereChildCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereParentCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereWishId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $casts = [
        'id' => 'integer',
        'wish_id' => 'integer',
	    'child_id' => 'integer',
	    'child_completed' => 'boolean',
	    'parent_completed' => 'boolean',
	    'fulfilled' => 'boolean',
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
}
