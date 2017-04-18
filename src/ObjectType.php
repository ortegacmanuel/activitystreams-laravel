<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

trait ObjectType
{

	public function asArray()
	{
		$object = Array();
		$object['id'] = $this->activityStreamsId;		
		$object['objectType'] = $this->activityStreamsObjectType;
		$object['content'] = $this->activityStreamsContent;
		$object['url'] = $this->activityStreamsUrl;		
		
		return $object;
	}

    public function getActivityStreamsIdAttribute()
    {
		return ActivityUtils::generateUri($this);
    }	

	public function getActivityStreamsObjectTypeAttribute()
	{
		return 'note';
	}

    public function getActivityStreamsContentAttribute()
    {
		return null;
    }

    public function getActivityStreamsUrlAttribute()
    {
		return null;
    }   
}