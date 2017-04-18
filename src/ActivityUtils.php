<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

use Carbon\Carbon;

class ActivityUtils
{

	static function generateUri($model) {
		// Example: 'tag:postactiv.local,2017-04-15:noticeId=1:objectType=note'
		$uri = 'tag:';
		
		$uri .= \Config::get('activitystreams-laravel.domain');
		$uri .= ',' . Carbon::now()->format('Y-m-d');
		$uri .= ':' . strtolower(class_basename($model)) . 'Id=' . $model->id;
		$uri .= ':objectType=' . $model->activityStreamsObjectType;

		return $uri;
   }

	static function generateActorUri($model) {
		// Example: 'tag:example.org,2011:martin',
		$uri = 'tag:';
		
		$uri .= \Config::get('activitystreams-laravel.domain');
		$uri .= ',' . Carbon::now()->format('Y');
		$uri .= ':' . strtolower(class_basename($model));

		return $uri;
   }   
}