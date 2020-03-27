<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

	protected $fillable = [ 'order', 'path', 'distro_id' ];

	public function distro()
	{
		return $this->belongsTo('App\Distro');
	}
}
