<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable=['user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
