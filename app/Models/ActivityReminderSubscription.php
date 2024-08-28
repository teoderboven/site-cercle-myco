<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class ActivityReminderSubscription extends Model{

	use HasCompositeKey;

	protected $primaryKey = [
		'activity_id',
		'subscriber_id'
	];

	protected $fillable = [
		'activity_id',
		'subscriber_id'
	];

	protected $casts = [
		'first_reminder_sent' => 'boolean',
		'second_reminder_sent' => 'boolean'
	];

	public $timestamps = false;

	public function activity(){
		return $this->belongsTo(Activity::class, 'activity_id');
	}

	public function subscriber(){
		return $this->belongsTo(MailSubscriber::class, 'subscriber_id');
	}
}
