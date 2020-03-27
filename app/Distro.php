<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distro extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'description'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends =[
        'name', 'description'
    ];

    public function categories()
    {
        return $this->hasManny('App\Category');
    }

    public function tags()
    {
	    return $this->hasManny('App\Tag');
    }

    public function images()
    {
	    return $this->hasManny('App\Image');
    }

    public function votes()
    {
	    return $this->hasManny('App\Vote');
    }
}
