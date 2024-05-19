<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
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
        'branch_id',
        'name',
        'phone',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function data()
    {
        return $this->hasMany(Data::class);
    }

    public function targets()
    {
        return $this->hasMany(Target::class);
    }
    
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}
