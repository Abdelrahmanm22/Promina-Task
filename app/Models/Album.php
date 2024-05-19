<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    //one to many relation
    public function pictures()
    {
        return $this->hasMany(Picture::class,'album_id');
    }

}
