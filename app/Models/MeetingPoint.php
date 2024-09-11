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

	/**
	 * Gives the formatted meeting point as "[name], [municipality]"
	 * @return string
	 */
	public function getFormatted(): string{
		return $this->name . ", " . $this->municipality;
	}

	/**
	 * Gives the Google Maps link URL to the meeting point
	 * @return string
	 */
	public function getMapsLink(): string{
		return "https://www.google.com/maps/search/?api=1&query=$this->latitude%2C$this->longitude";
	}

	public function activities(){
		return $this->hasMany(Activity::class, 'meeting_point');
	}
}
