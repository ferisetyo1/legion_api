<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $primaryKey = "banner_id";
    public $table = "legion_banner";
    public $timestamps = false;
    protected $fillable = [
        'banner_gambar',
        'banner_kategori',
        'banner_detail',
    ];
}
