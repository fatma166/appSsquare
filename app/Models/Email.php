<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 * 
 * @property int $id
 * @property int $from
 * @property int $to
 * @property string $body
 * @property string $title
 * @property int $status
 * @property Carbon $created_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Email extends Model
{
	protected $table = 'emails';
	public $timestamps = false;

	protected $casts = [
		'from' => 'int',
		'to' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'from',
		'to',
		'body',
		'title',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'to');
	}
}
