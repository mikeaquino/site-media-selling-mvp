<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaList extends Model
{
	protected $guarded = [];

	public function scopeMediaGroupId($query, $groupId)
	{
		return $query->where('mediagroup_id', $groupId);
	}

	public function scopeAscending($query)
	{
		return $query->orderBy('media_filesize', 'ASC');
	}

	public function scopeDescending($query)
	{
		return $query->orderBy('media_filesize', 'DESC');
	}
}
