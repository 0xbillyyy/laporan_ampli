<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Relasi ke Monitoring: Platform memiliki banyak Monitoring
    public function monitorings()
    {
        return $this->hasMany(Monitoring::class, 'platform_id', 'id'); // Tanpa foreign key constraint
    }
}
