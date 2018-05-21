<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable=['news_title','imgPath','news_url','news_date'];
}
