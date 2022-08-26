<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
use HasFactory, Notifiable;

/**
* The attributes that are mass assignable.
*
* @var array<int, string>
*/
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


/**
* The attributes that should be hidden for serialization.
*
* @var array<int, string>
*/
protected $hidden = [
'password',
'remember_token',
];

/**
* The attributes that should be cast.
*
* @var array<string, string>
*/
    protected $casts = [
    'email_verified_at' => 'datetime',
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
    /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
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
