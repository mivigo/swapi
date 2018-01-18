<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
    protected $fillable =[
        'name',
        'height',
        'mass',
        'hair_color',
        'skin_color',
        'eye_color',
        'birth_year',
        'gender',
        'homeworld',
        'films',
        'species',
        'vehicles',
        'starships',
        'created',
        'edited',
        'url'
    ];

    protected $dates = ['published_at'];

    public function setPublishedAtAttribute($date){
        $this->attributes['published_at'] = Carbon::parse($date);
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
