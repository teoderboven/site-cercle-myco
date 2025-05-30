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
	 * Generates a new unique identifier for the activity.
	 *
	 * This method uses the NanoID library to create a unique ID
	 * with a specified length, prefixed with 'a' to indicate it's an activity.
	 *
	 * @return string The newly generated unique identifier.
	 */
	public function newUniqueId(): string{
		$length = config('cmb.activity_id_length');
		
		$nano = new Nanoid\Client();
		return 'a' . $nano->generateId($length - 1, Nanoid\Client::MODE_DYNAMIC); // -1 because of the 'a' prefix
	}

	/**
	 * Returns the unique identifiers for the model.
	 *
	 * This method is used by the HasUuids trait to determine which
	 * attributes should be treated as unique identifiers.
	 *
	 * @return array<int, string> An array of attribute names that are unique identifiers.
	 */
	public function uniqueIds(): array{
		return ['id'];
	}

	/**
	 * Generates and returns the detail link for the activity.
	 *
	 * @return string The URL to the activity's detail page.
	 */
	public function getDetailLink(): string{
		return route('activityDetail', $this->id);
	}

	/**
	 * Calculates the number of full days remaining until the activity starts.
	 *
	 * @param \Carbon\Carbon|null $currentDate The current date to compare with. If null, the current date and time will be used.
	 * @return int The number of full days until the activity starts.
	 */
	public function fullDaysUntilStart(Carbon $currentDate = null): int{
		$currentDate = $currentDate ?? Carbon::now();
		return (int) $currentDate->startOfDay()->diffInDays($this->start_date->startOfDay(), false);
	}

	/**
	 * Retrieves the next upcoming activity.
	 *
	 * This method checks that the activity is not cancelled, is visible,
	 * and has a start date in the future.
	 *
	 * @return Activity|null the next upcoming Activity instance, or null if none exists.
	 */
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
