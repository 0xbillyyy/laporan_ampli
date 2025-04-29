<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform_id', 'user_id', 'link', 'content', 'author', "like", "comment", "share", "view", 'published_at'
    ];

    // Relasi ke Platform
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
