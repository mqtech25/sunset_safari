<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEmail extends Model
{
    protected $table = 'contact_emails';

	protected $fillable = [
		'id', 'name', 'email', 'message', 'status', 'created_at', 'updated_at',
	];
}
