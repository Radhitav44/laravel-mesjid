<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function views()
    {
        return $this->hasMany('App\Models\PostView');
    }
}
