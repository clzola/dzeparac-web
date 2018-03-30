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
 * @property bool $is_finished
 * @property bool $is_completed
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Dzeparac\User $child
 * @property-read \Dzeparac\Wish $wish
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereIsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereIsFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dzeparac\Task whereWishId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'name',
    ];

    public $casts = [
        'id' => 'integer',
        'wish_id' => 'integer',
	    'child_id' => 'integer',
	    'is_finished' => 'boolean',
	    'is_completed' => 'boolean',
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
}
