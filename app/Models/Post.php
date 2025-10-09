<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'publish_date',
        'image',
        'is_publish',
        'user_id',
    ];

    /**
     * Relasi: Post dimiliki oleh satu User
     */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function getStatusLabelAttribute()
	{
		return $this->is_publish ? 'Published' : 'Draft';
	}

	public function scopePublished($query)
	{
		return $query->where('is_publish', true);
	}

}
