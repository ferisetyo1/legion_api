<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainer extends Model
{
    use HasFactory;
    protected $primaryKey = "pt_id";
    protected $table = "legion_pt";
    public $timestamps = false;
    protected $fillable = [
        'pt_gym_id',
        'pt_user_id',
        'pt_nama',
        'pt_tanggal_lahir',
        'pt_gender',
        'pt_desc',
        'pt_image',
        'pt_kota',
        'pt_alamat',
        'pt_is_delete'
    ];
    protected $appends = ["pt_star_count", "pt_default_harga"];

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

    public function getPtDefaultHargaAttribute()
    {
        return HargaTrainer::firstWhere("ht_pt_id", $this->pt_id);
    }

    public function review()
    {
        return  $this->hasMany(RatingReview::class, "rr_pt_id", "pt_id");
    }
    public function harga()
    {
        return  $this->hasMany(HargaTrainer::class, "ht_pt_id", "pt_id");
    }
    public function gym()
    {
        return  $this->belongsTo(gym::class, "pt_gym_id", "gym_id");
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalTrainer::class, "jt_pt_id", "pt_id")->where('jt_pt_confirm', 1)->where('jt_gym_confirm', 1);
    }

    public function getPtNamaAttribute($s)
    {
        return ucwords($s);
    }
}
