<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tambahkan relasi untuk likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Tambahkan relasi untuk comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
