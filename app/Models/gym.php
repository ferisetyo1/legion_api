<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gym extends Model
{
    use HasFactory;
    protected $table = "legion_gym";
    protected $primaryKey = "gym_id";
    protected $fillable = [
        'gym_user_id',
        'gym_nama',
        'gym_alamat',
        'gym_longitude',
        'gym_latitude',
        'gym_isActive',
        'gym_status',
        'gym_desc',
        'gym_image',
    ];

    protected $appends = ["gym_star_count"];

    public function getGymStarCountAttribute()
    {
        $review = RatingReview::where('rr_gym_id', $this->gym_id)->get();
        $star_count = 0;
        $i = 0;
        foreach ($review as $key => $value) {
            $star_count += $value->rr_star;
            $i++;
        }
        if ($i > 0 && $star_count > 0) return $star_count / $i;
        else return 0;
    }

    public function trainer()
    {
        return $this->hasMany(trainer::class, "pt_gym_id", "gym_id");
    }

    public function review()
    {
        return  $this->hasMany(RatingReview::class, "rr_gym_id", "gym_id")->take(2);
    }
    
    public function fasilitas()
    {
        return  $this->hasMany(fasilitas::class, "gf_gym_id", "gym_id");
    }
}
