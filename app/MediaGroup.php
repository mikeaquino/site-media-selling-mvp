<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaGroup extends Model
{
	protected $guarded = [];

	public function scopeMediaGroupOwner($query, $userEmail)
	{
		return $query->where('user_email', $userEmail);
	}
}
