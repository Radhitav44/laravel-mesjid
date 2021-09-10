<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function questioner()
    {
        return $this->belongsTo('App\Models\User', 'questioner_id');
    }

    public function checker()
    {
        return $this->belongsTo('App\Models\User', 'checker_id');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }
}
