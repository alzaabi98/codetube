<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\softDeletes;

class Comment extends Model
{

	use softDeletes;
    
    protected $fillable = [

    	'body',
    	'user_id',
    	'reply_id',
    ]; 


    public function commentable() {
    	

    	return $this->morphTo();
    }


    public function replies() {
    	

    	return $this->hasMany(Comment::class, 'reply_id','id');
    }


    public function user() {
    	
    	return $this->belongsTo(User::class);
    }
    
    
    
}
