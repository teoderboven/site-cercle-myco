<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MailSubscriber extends Model{
	
	use HasUuids;

	public $incrementing = false;
	protected $keyType = 'string';

	protected $fillable = [
		'email'
	];

	protected $casts = [
		'unsubscribed' => 'boolean'
	];

	protected $hidden = [
		'unsubscribe_token'
	];

	public $timestamps = false;

	public function subscriptions(){
		return $this->hasMany(ActivityReminderSubscription::class, 'subscriber_id');
	}
	
	public function assignUnsubscribeToken(): void{
		$this->unsubscribe_token = Str::random(32);
	}

	protected static function booted(){
		static::creating(function($subscriber){
			if(empty($subscriber->unsubscribe_token)) {
				$subscriber->assignUnsubscribeToken();
			}
		});
	}

}
