<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public $table = "legion_banner";
    protected $fillable = [
        'banner_gambar',
        'banner_kategori',
        'banner_detail',
    ];
}
