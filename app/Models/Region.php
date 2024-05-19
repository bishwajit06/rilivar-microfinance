<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug'
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
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
