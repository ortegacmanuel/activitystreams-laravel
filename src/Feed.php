<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

class Feed {
    public $channel;
    public $items;
    private $content_type;

    public function render($format = 'atom', $items, $cache = FALSE, $cacheTime = 3600){
        $channel = $this->channel;
        $channel->pubdate = $this->formatDate($this->channel->pubdate,$format);

        if($format == 'atom') {
            $this->content_type = 'application/atom+xml';
        } else {
            $this->content_type = 'application/rss+xml';
        }

        if($cache == TRUE && Cache::has('feed-'.$format)) {
            return response()->view('atomfeed::'.$format,Cache::get('feed-'.$format))->header('Content-Type',$this->content_type)->header('Content-Type','text/xml');
        } elseif($cache == TRUE) {
            Cache::put('feed-'.$format,compact('channel','items'),$cacheTime);
            return response()->view('atomfeed::'.$format,compact('channel','items'))->header('Content-Type',$this->content_type)->header('Content-Type','text/xml');
        } elseif($cache == FALSE && Cache::has('feed-'.$format)) {
            Cache::forget('feed-'.$format);
            return response()->view('atomfeed::'.$format,compact('channel','items'))->header('Content-Type',$this->content_type)->header('Content-Type','text/xml');
        } else {
            return response()->view('atomfeed::'.$format,compact('channel','items'))->header('Content-Type',$this->content_type)->header('Content-Type','text/xml');
        }
        
    }
    public function setChannel($data)
    {
       $this->channel = new Channel($data);
    }

    protected function formatDate($date, $format='atom')
    {
        if ($format == "atom")
        {
            $date = date('c', strtotime($date));
        }
        else
        {
            $date = date('D, d M Y H:i:s O', strtotime($date));
        }
        return $date;
    }
    public function getPubdate() {
        return date('D, d M Y H:i:s O');
    }
    public function getLang() {
        return Config::get('app.locale');
    }
    public function getURL() {
        return Request::url();
    }
}