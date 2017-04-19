<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

trait ActorType
{

	protected $activityStreamsObjectType = 'person';

	public function asActivityObjectAs()
	{
		$object = Array();
		$object['id'] = $this->activityStreamsId;
		$object['displayName'] = $this->activityStreamsDisplayName;
		$object['objectType'] = $this->activityStreamsObjectType;
		$object['url'] = $this->activityStreamsUrl;		
		
		return $object;
	}

	public function asActivityObjectAtom()
	{
		 $autor = '<author>
  <activity:object-type>' . ActivityObject::iriType($this->activityStreamsObjectType) . '</activity:object-type>
  <uri>' . $this->activityStreamsId . '</uri>
  <name>'. $this->activityStreamsDisplayName . '</name>
  <poco:preferredUsername>'. $this->activityStreamsDisplayName . '</poco:preferredUsername>
  <poco:displayName>'. $this->activityStreamsDisplayName . '</poco:displayName>
  <statusnet:profile_info local_id="' . $this->id . '" following="true" blocking="false"></statusnet:profile_info>
</author>';

		 return $autor;	
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