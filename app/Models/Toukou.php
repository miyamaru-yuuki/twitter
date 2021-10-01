<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Toukou
 *
 * @property int $toukouId
 * @property int|null $userId
 * @property int|null $originalToukouId
 * @property string|null $contents
 * @property string|null $hi
 * @method static \Illuminate\Database\Eloquent\Builder|Toukou newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Toukou newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Toukou query()
 * @method static \Illuminate\Database\Eloquent\Builder|Toukou whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toukou whereHi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toukou whereOriginalToukouId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toukou whereToukouId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toukou whereUserId($value)
 * @mixin \Eloquent
 */
class Toukou extends Model
{
    protected $table = 'toukou';
    protected $guarded = array('toukouid');
    protected $primaryKey = 'toukouid';
    public $timestamps = false;
}