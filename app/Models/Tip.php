<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_a',
        'team_b',
        'country_league',
        'other_score',
        'correct_tip',
        'correct_odd',
        'match_time',
        'is_vip'
    ];
}
