<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsletterUsers extends Model
{
	protected $fillable = [
		'newsletter_email',
	];
}
