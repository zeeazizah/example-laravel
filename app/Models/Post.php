<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
		'title',
		'content',
		'published_at',
		'image',
		'user_id'
	];

	public function user(){
		// Many to One
		return $this->belongsTo(User::class);
	}
}
