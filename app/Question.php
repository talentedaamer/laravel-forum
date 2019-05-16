<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    protected $fillable = [
        'title', 'body'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function getUrlAttribute()
    {
        return route( 'questions.show', $this->id );
    }
    
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    
    public function getStatusAttribute()
    {
        if ( $this->answers > 0 ) {
            if ( $this->accepted_answer ) {
                return 'ans-is-accepted';
            }
            return 'is-ansed';
        }
        
        return 'is-unansed';
    }
    
    public function getVoteStatusAttribute()
    {
        if ( $this->votes > 0 ) {
            return 'has-votes';
        } elseif ( $this->votes < 0 ) {
            return 'neg-votes';
        } else {
            return 'no-votes';
        }
    }
    
    public function getViewStatusAttribute()
    {
        if ( $this->views > 0 ) {
            return 'has-views';
        }
    
        return 'no-views';
    }
}
