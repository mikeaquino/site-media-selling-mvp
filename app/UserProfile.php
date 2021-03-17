<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
	protected $table = 'users_profile';
	protected $guarded = [];

	public function scopeGetEmail($query, $userEmail)
	{
		return $query->where('user_email', $userEmail);
	}
}
