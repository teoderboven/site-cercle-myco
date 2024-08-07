<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model{

	protected $fillable = [
		'name',
		'phone'
	];

	protected $hidden = [
		'id'
	];

	public $timestamps = false;

	public function activities(){
		return $this->hasMany(Activity::class, 'guide');
	}
}
