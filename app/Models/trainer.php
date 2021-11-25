<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainer extends Model
{
    use HasFactory;
    protected $primaryKey = "pt_id";
    protected $table="legion_pt";
    protected $fillable = [
        'pt_gym_id',
        'pt_user_id',
        'pt_nama',
        'pt_tanggal_lahir',
        'pt_gender',
        'pt_desc',
        'pt_image',
    ];
    protected $appends = ["pt_star_count"];

    public function getPtStarCountAttribute()
    {
        $review = RatingReview::where('rr_pt_id', $this->pt_id)->get();
        $star_count = 0;
        $i = 0;
        foreach ($review as $key => $value) {
            $star_count += $value->rr_star;
            $i++;
        }
        if ($i > 0 && $star_count > 0) return $star_count / $i;
        else return 0;
    }
    public function review()
    {
        return  $this->hasMany(RatingReview::class,"rr_pt_id","pt_id");
    }
}
