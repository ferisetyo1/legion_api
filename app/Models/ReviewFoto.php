<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewFoto extends Model
{
    use HasFactory;
    protected $primaryKey = "rf_id";
    public $table = "legion_review_fotos";
    public $timestamps = false;
    protected $fillable = [
        'rf_rr_id',
        'rf_image_url',
    ];
}
