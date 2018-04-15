<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id','body','commentable_id','commentble_type','level','parent_id'];

    public function commentable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
