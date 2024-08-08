<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLink extends Model{

	protected $fillable = [
		'activity_id',
		'link_text',
		'url'
	];
	
	protected $hidden = [
		'id',
		'activity_id'
	];

	public $timestamps = false;

	public function activity(){
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
