<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

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

    public function actor()
    {
        return $this->belongsTo(
            \Config::get('activitystreams-laravel.actor_model'),
             'user_id'
        );
    }

    public function objectable()
    {
        return $this->morphTo();
    }

    public function createActivity($user, $model)
    {
        $activity = new Activity([
            'uri' => 'tag:postactiv.local,2017-04-15:noticeId=1:objectType=note',
            'verb' => 'http://activitystrea.ms/schema/1.0/post',
            'object_type' => 'http://activitystrea.ms/schema/1.0/note'
        ]);

        $activity->actor()->associate($user);
        $activity->objectable()->associate($model);

        $activity->save();

        return $activity;
    }
}