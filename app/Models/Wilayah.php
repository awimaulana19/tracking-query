<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'md_wilayah_administrasi';
    public $timestamps = false;
    protected $primaryKey = 'kode';

    protected $casts = [
        'kode' => 'string',
    ];

    protected $fillable = [
        'kode',
    ];
}
