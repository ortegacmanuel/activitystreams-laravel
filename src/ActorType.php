<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

trait ActorType
{

	protected $activityStreamsObjectType = 'person';	

	public function asArray()
	{
		$object = Array();
		$object['id'] = $this->activityStreamsId;
		$object['displayName'] = $this->activityStreamsDisplayName;
		$object['objectType'] = $this->activityStreamsObjectType;
		$object['url'] = $this->activityStreamsUrl;		
		
		return $object;
	}

	public function getActivityStreamsObjectType()
	{
		return $this->activityStreamsObjectType;
	}

    public function getActivityStreamsIdAttribute()
    {
		return ActivityUtils::generateActorUri($this);
    }

    public function getActivityStreamsDisplayNameAttribute()
    {
		return strtolower(class_basename($this));
    }

    public function getActivityStreamsObjectTypeAttribute()
    {
		return $this->activityStreamsObjectType;
    }

    public function getActivityStreamsUrlAttribute()
    {
		return null;
    }
}