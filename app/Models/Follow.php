<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Follow
 *
 * @property int $followId
 * @property int|null $myUserId
 * @property int|null $followUserId
 * @method static \Illuminate\Database\Eloquent\Builder|Follow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Follow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Follow query()
 * @method static \Illuminate\Database\Eloquent\Builder|Follow whereFollowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Follow whereFollowUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Follow whereMyUserId($value)
 * @mixin \Eloquent
 */
class Follow extends Model
{
    protected $table = 'follow';
    protected $guarded = array('followId');
    protected $primaryKey = 'followId';
    public $timestamps = false;
}