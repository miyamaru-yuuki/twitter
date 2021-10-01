<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 */
	class Follow extends \Eloquent {}
}

namespace App\Models{
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
 */
	class Toukou extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $api_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
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
 */
	class User2 extends \Eloquent {}
}

