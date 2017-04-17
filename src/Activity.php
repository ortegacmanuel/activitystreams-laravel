<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

use Illuminate\Database\Eloquent\Model;

class BaseActivity extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'uri',
        'object_type',
        'verb',
    ];
}