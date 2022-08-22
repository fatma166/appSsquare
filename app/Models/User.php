<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class User
 *
 * @property int $id
 * @property int|null $role_id
 * @property int $manger_Parent
 * @property string $name
 * @property string|null $email
 * @property Carbon $birth_date
 * @property bool|null $email_isverified
 * @property string|null $avatar
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $phone
 * @property bool|null $phone_isverified
 * @property string|null $device_token
 * @property Carbon $join_date
 * @property bool $active
 * @property string|null $device_info
 * @property Carbon|null $last_login
 *
 * @property Role|null $role
 * @property Collection|Email[] $emails
 * @property Collection|LeaveRequest[] $leave_requests
 * @property Collection|Notification[] $notifications
 *
 * @package App\Models
 */

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasFactory;
	use SoftDeletes;
	protected $table = 'users';

	protected $casts = [
		'role_id' => 'int',
		'manger_Parent' => 'int',
		'email_isverified' => 'bool',
		'phone_isverified' => 'bool',
		'active' => 'bool'
	];

	protected $dates = [
		'birth_date',
		'email_verified_at',
		'join_date',
		'last_login'
	];

	protected $hidden = [
		'password',
		'remember_token',
		'device_token'
	];

	protected $fillable = [
		'role_id',
		'manger_Parent',
		'name',
		'email',
		'birth_date',
		'email_isverified',
		'avatar',
		'email_verified_at',
		'password',
		'remember_token',
		'phone',
		'phone_isverified',
		'device_token',
		'join_date',
		'active',
		'device_info',
		'last_login'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function emails()
	{
		return $this->hasMany(Email::class, 'to');
	}

	public function leave_requests()
	{
		return $this->hasMany(LeaveRequest::class);
	}

	public function notifications()
	{
		return $this->hasMany(Notification::class, 'to');
	}
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
