<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 *
 * @property int $id
 * @property string $title
 * @property string $message
 * @property int $from
 * @property int $to
 * @property string $type
 * @property string $status
 * @property Carbon $created_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notifications';
	public $timestamps = false;

	protected $casts = [
		'from' => 'int',
		'to' => 'int'
	];

	protected $fillable = [
		'title',
		'message',
		'from',
		'to',
		'type',
		'status',
        'data_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'to');
	}
}
