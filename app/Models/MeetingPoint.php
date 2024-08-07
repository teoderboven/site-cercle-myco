<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingPoint extends Model{

	protected $fillable = [
		'name',
		'municipality',
		'latitude',
		'longitude'
	];
	
	protected $hidden = [
		'id'
	];

	public $timestamps = false;

	public function activities(){
        return $this->hasMany(Activity::class, 'meeting_point');
    }
}
