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
        return route( 'questions.show', $this->slug );
    }
    
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    
    public function getStatusAttribute()
    {
        if ( $this->answers_count > 0 ) {
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
    
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text( $this->body );
    }
    
    public function answers()
    {
        return $this->hasCast('App\Answer');
    }
}
