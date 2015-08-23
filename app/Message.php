<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Markdown;

class Message extends Model
{

    protected $fillable = ['user_id_from', 'user_id_to', 'body'];

    protected $appends = ['title'];
    
    public function fromUser()
    {
        return $this->belongsTo('App\User', 'user_id_from');
    }

    public function toUser()
    {
        return $this->belongsTo('App\User', 'user_id_to');
    }

   public function getTitleAttribute()
   {
       return str_limit($this->attributes['body'], 30);
   }

   public function getBodyAttribute($value)
   {
       $value = Markdown::parse($value);
       return $value;
   }

}
