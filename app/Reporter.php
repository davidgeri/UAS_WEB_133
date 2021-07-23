<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporter extends Model
{
    protected $table = 'Reporter';

    protected $fillable = ['nama','jenis_kelamin','alamat','email','news_id'];

    public function berita()
    {
        return $this->belongsTo(News::class,'news_id');
    }
    
}
