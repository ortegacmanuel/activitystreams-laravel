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
        'content',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];    

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

    public function createActivity($verb = 'post', $user, $model, $content = '')
    {
        $activity = new Activity([
            'uri' => ActivityUtils::generateUri($model),
            'verb' => ActivityVerb::canonical($verb),
            'object_type' => ActivityObject::canonicalType($model->activityStreamsObjectType),
            'content' => $content
        ]);

        $activity->actor()->associate($user);
        $activity->objectable()->associate($model);

        $activity->save();

        return $activity;
    }

    public function asArray()
    {
        $object = Array();
        $object['actor'] = $this->actor->asArray();
        $object['content'] = $this->content;
        $object['id'] = $this->uri;
        $object['object'] = $this->objectable->asArray();
        $object['published'] = $this->created_at->format('Y-m-d\TH:i:sP');
        $object['verb'] = $this->verb;
        $object['url'] = $this->activityStreamsUrl;        
        
        return $object;
    }

    public function getActivityStreamsUrlAttribute()
    {
        return null;
    }   
}