<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class new_posts extends Model
{
    use HasFactory;

	protected $table = 'new_posts';

	protected $fillable = [
		'title',
		'content'
	];
}
