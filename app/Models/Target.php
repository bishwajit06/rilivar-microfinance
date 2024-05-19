<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'staff_id',
        'particular_id',
        'p_june',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
        'ac_january',
        'ac_february',
        'ac_march',
        'ac_april',
        'ac_may',
        'ac_june',
        'ac_july',
        'ac_august',
        'ac_september',
        'ac_october',
        'ac_november',
        'ac_december',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function particular()
    {
        return $this->belongsTo(Particular::class);
    }
}
