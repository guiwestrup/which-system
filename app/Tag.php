<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'description', 'image_path', 'icon_path'
	];

    public function distro()
    {
	    return $this->belogsTo('App\Distro');
    }


}
