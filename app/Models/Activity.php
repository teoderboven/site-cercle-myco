<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Hidehalo\Nanoid;
use Carbon\Carbon;

class Activity extends Model{

	use HasUuids;

	protected $table = "activities";

	public $incrementing = false;
	protected $keyType = 'string';

	protected $fillable = [
		'title',
		'guide_id',
		'start_date',
		'duration',
		'description',
		'meeting_point',
		'visible',
		'updated_by'
	];

	protected $with = [
		'guide',
		'meetingPoint',
		'links',
		'updatedBy'
	];

	protected $casts = [
		'cancelled' => 'boolean',
		'visible' => 'boolean',
		'start_date' => 'datetime',
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

	/**
	 * Generate a new NanoID for the model.
	 */
	public function newUniqueId(): string{
		$length = env('CMB_ACTIVITY_ID_LENGTH', 16);
		
		$nano = new Nanoid\Client();
		return 'a' . $nano->generateId($length - 1, Nanoid\Client::MODE_DYNAMIC); // -1 because of the 'a' prefix
	}

	/**
	 * Get the columns that should receive a unique identifier.
	 * @return array<int, string>
	 */
	public function uniqueIds(): array{
		return ['id'];
	}

	/**
	 * Gives the activity detail link to see the activity online
	 * @return string
	 */
	public function getDetailLink(): string{
		return route('activityDetail', $this->id);
	}

	/**
	 * Determines the number of days until the start of the activity
	 * @param Carbon|null $currentDate
	 * @return integer
	 */
	public function fullDaysUntilStart(Carbon $currentDate = null): int{
		$currentDate = $currentDate ?? Carbon::now();
		return (int) $currentDate->startOfDay()->diffInDays($this->start_date->startOfDay(), false);
	}

	public static function getNextUpcomingActivity(): ?Activity{
		return self::where('cancelled', false)
					->where('visible', true)
					->where('start_date', '>', now())
					->orderBy('start_date', 'asc')
					->first();
	}

	public function guide(){
		return $this->belongsTo(Guide::class);
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
