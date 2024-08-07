<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model{

	protected $table = "activities";

	protected $fillable = [
		'title',
		'guide',
		'start_date',
		'duration',
		'description',
		'meeting_point'
	];
	
	protected $hidden = [
		'id'
	];

	protected $casts = [
        'cancelled' => 'boolean',
    ];

	public $timestamps = false;
	/* /!\
	the database is configured to update timestamps and not Eloquent
		> (...)
		> created_time timestamp default CURRENT_TIMESTAMP,
		> updated_time timestamp default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
		> (...)
	see the .sql file that creates the database
	*/

	public function guide(){
		return $this->belongsTo(Guide::class, 'guide');
	}

	public function meetingPoint(){
		return $this->belongsTo(MeetingPoint::class, 'meeting_point');
	}

	public function updatedBy(){
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function links(){
		return $this->hasMany(ActivityLink::class, 'activity_id');
	}
}
