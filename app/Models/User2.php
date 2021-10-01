<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User2
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $api_token
 * @property string|null $remember_token
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|User2 newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User2 newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User2 query()
 * @method static \Illuminate\Database\Eloquent\Builder|User2 whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User2 whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User2 whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User2 whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User2 whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User2 whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User2 wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User2 whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User2 whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User2 extends Model
{
    protected $table = 'users';
    protected $guarded = array('id');
    protected $primaryKey = 'id';
    public $timestamps = false;
}