<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        "id_platform",
        "link",
        "context",
        "created_at",
        "updated_at"
    ];

    // Relasi ke Platform
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }


}
