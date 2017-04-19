<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

trait ObjectType
{

	public function asActivityObjectAs()
	{
		$object = Array();
		$object['id'] = $this->activityStreamsId;		
		$object['objectType'] = $this->activityStreamsObjectType;
		$object['content'] = $this->activityStreamsContent;
		$object['url'] = $this->activityStreamsUrl;		
		
		return $object;
	}

	public function asActivityObjectAtom()
	{
		$object = '<activity:object-type>' . ActivityObject::iriType($this->activityStreamsObjectType) . '</activity:object-type>
<id>' . $this->activityStreamsId . '</id>
<content type="html">'. $this->activityStreamsContent . '</content>
<link rel="alternate" type="text/html" href="' . $this->activityStreamsUrl . '"/>
<status_net notice_id="' . $this->id . '"></status_net>';

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