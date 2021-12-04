<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingReview extends Model
{
    use HasFactory;
    protected $primaryKey = "rr_id";
    public $table = "legion_rating_reviews";
    public $timestamps = false;
    protected $fillable = [
        'rr_user_id',
        'rr_gym_id',
        'rr_produk_id',
        'rr_pt_id',
        'rr_star',
        'rr_desc'
    ];
    protected $appends = ["rr_foto","rr_user"];
    public function getRrFotoAttribute()
    {
        return ReviewFoto::where('rf_rr_id',$this->rr_id)->get();
    }

    public function getRrUserAttribute()
    {
        return User::find($this->rr_user_id);
    }
}
