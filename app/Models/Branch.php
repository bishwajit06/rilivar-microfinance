<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'region_id',
        'name',
        'slug',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    
}
