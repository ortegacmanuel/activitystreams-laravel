<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Ortegacmanuel\PubsubhubbubLaravel\PubsubhubbubUtils;

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
    protected $dates = ['created_at', 'updated_at'];    

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

    public function asActivityObject($format = 'as')
    {
        if($format == 'as')
        {
            return $this->asActivityObjectAs();
        }

        if($format = 'atom')
        {
            return $this->asActivityObjectAtom();           
        }

        return null;
    }    

    public function asActivityObjectAs()
    {
        $object = Array();
        $object['actor'] = $this->actor->asActivityObjectAs();
        $object['content'] = $this->content;
        $object['id'] = $this->uri;
        $object['object'] = $this->objectable->asActivityObjectAs();
        $object['published'] = $this->created_at->format('Y-m-d\TH:i:sP');
        $object['verb'] = $this->verb;
        $object['url'] = $this->activityStreamsUrl;        
        
        return $object;
    }

    public function asActivityObjectAtom()
    {
        $entry = '<entry>
  ' . $this->objectable->asActivityObjectAtom() .
'<title>' . $this->content . '</title>
<activity:verb>' . ActivityVerb::iriType($this->verb) . '</activity:verb>
<published>' . $this->created_at->format('Y-m-d\TH:i:sP') . '</published>
<updated>' . $this->created_at->format('Y-m-d\TH:i:sP') . '</updated>
  ' . $this->actor->asActivityObjectAtom() .
'<source>
<id>http://postactiv.local/api/statuses/user_timeline/1.atom</id>
<title>admin</title>
<link rel="alternate" type="text/html" href="http://postactiv.local/admin"/>
<link rel="self" type="application/atom+xml" href="http://postactiv.local/api/statuses/user_timeline/1.atom"/>
<link rel="license" href="https://creativecommons.org/licenses/by/3.0/"/>
<updated>2017-04-19T14:07:23+00:00</updated>
</source>
<link rel="self" type="application/atom+xml" href="'. $this->activityStreamsUrl . '"/>
<link rel="edit" type="application/atom+xml" href="'. $this->activityStreamsUrl . '"/>
<statusnet:notice_info local_id="' . $this->id . '" source="web" repeated="false" favorite="false"></statusnet:notice_info>
</entry>';

        return $entry;
    }

    public function userFeedForNotice()
    {
        $userFeedForNotice = '<?xml version="1.0" encoding="UTF-8"?>
<feed xml:lang="en-US" xmlns="http://www.w3.org/2005/Atom" xmlns:thr="http://purl.org/syndication/thread/1.0" xmlns:georss="http://www.georss.org/georss" xmlns:activity="http://activitystrea.ms/spec/1.0/" xmlns:media="http://purl.org/syndication/atommedia" xmlns:poco="http://portablecontacts.net/spec/1.0" xmlns:ostatus="http://ostatus.org/schema/1.0" xmlns:statusnet="http://status.net/schema/api/1/">
 <generator uri="https://gnu.io/social" version="1.0.2-dev">GNU social</generator>
 <id>' . route('user_feed', $this->actor). '</id>
 <title>' . $this->actor->activityStreamsDisplayName . ' timeline</title>
 <subtitle>Updates from ' . $this->actor->activityStreamsDisplayName . ' on Postactiv main!</subtitle>
 <updated>' . Carbon::now() . '</updated>
 ' . $this->actor->asActivityObjectAtom() . '
 ' . PubsubhubbubUtils::atomHubLink() . '
 <link href="' . route('user_feed', $this->actor) . '" rel="self" type="application/atom+xml"/>
' . $this->asActivityObjectAtom() . '
</feed>';

        return $userFeedForNotice;
    }

    public function getActivityStreamsUrlAttribute()
    {
        return null;
    }   
}