<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionRole
 * 
 * @property int $role_id
 * @property int $permission_id
 * 
 * @property Permission $permission
 * @property Role $role
 *
 * @package App\Models
 */
class PermissionRole extends Model
{
	protected $table = 'permission_roles';
	protected $primaryKey = 'role_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'role_id' => 'int',
		'permission_id' => 'int'
	];

	protected $fillable = [
		'permission_id'
	];

	public function permission()
	{
		return $this->belongsTo(Permission::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}
}
