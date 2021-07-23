<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'News';

    protected $fillable = ['jenis_berita','lokasi_kejadian','waktu','narasumber'];
}
