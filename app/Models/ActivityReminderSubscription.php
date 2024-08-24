<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityReminderSubscription extends Model{

	protected $fillable = [
		'activity_id',
		'email'
	];

	protected $casts = [
		'first_reminder_sent' => 'boolean',
		'second_reminder_sent' => 'boolean'
	];

	public $timestamps = false;

	public function activity(){
		return $this->belongsTo(Activity::class, 'activity_id');
	}
}
