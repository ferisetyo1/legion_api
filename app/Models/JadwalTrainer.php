<?php

namespace App\Models;

use App\Casts\KategoriesjadwalTrainer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTrainer extends Model
{
    use HasFactory;
    protected $table="legion_jadwal_trainers";
    protected $primaryKey = "jt_id";
    public $timestamps = false;
    protected $fillable = [
        'jt_pt_id',
        'jt_gym_id',
        'jt_pt_confirm',
        'jt_gym_confirm',
        'jt_hari',
        'jt_kategories',
    ];
    
    protected $casts = [
        'jt_kategories' => KategoriesjadwalTrainer::class,
    ];

    public function getJtHariAttribute($s)
    {
        return ucwords($s);
    }
}
