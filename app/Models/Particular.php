<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particular extends Model
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


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function targets()
    {
        return $this->hasMany(Target::class);
    }
}
