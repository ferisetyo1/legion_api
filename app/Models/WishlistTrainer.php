<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistTrainer extends Model
{
    use HasFactory;
    protected $primaryKey = "wt_id";
    protected $table="legion_wishlist_trainers";
    public $timestamps = false;
    protected $fillable = [
        'wt_user_id',
        'wt_pt_id',
    ];

    public function wtTrainer()
    {
        return $this->belongsTo(trainer::class,'wt_pt_id','pt_id');
    }
}
