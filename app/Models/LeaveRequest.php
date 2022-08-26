<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LeaveRequest
 *
 * @property int $id
 * @property Carbon $date
 * @property int $user_id
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class LeaveRequest extends Model
{
	protected $table = 'leave_requests';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'date',
		'user_id',
        'leave_from',
        'leave_to',
		'status',
        'num_hours',
        'days'


	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
