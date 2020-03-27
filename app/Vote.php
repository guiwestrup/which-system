<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use SoftDeletes;
	protected $fillable = [ 'user_id', 'distro_id', 'value' ];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function distro()
	{
		return $this->belongsTo('App\Distro');
	}
}
