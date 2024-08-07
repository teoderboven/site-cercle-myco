<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model/* Authenticatable */{

	protected $fillable = [
		'name',
		// 'email',
		// 'password',
	];
	
	protected $hidden = [
		'id'
	];

	
	// protected $hidden = [
	// 	'password',
	// 	'remember_token',
	// ];

	// protected function casts(): array
	// {
	// 	return [
	// 		'email_verified_at' => 'datetime',
	// 		'password' => 'hashed',
	// 	];
	// }
}
