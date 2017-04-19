<?php
/**
 * Created by PhpStorm.
 * User: TrueRazor
 * Date: 4/7/16
 * Time: 9:10 PM
 */
namespace Ortegacmanuel\ActivitystreamsLaravel;

class Channel extends Feed {
    public $title;
    public $link;
    public $description;
    public $lang;
    public $logo;
    public $icon;
    public $pubdate;
    public function __construct($data)
    {
        foreach($data as $name => $value) {
            if(property_exists(get_called_class(),$name)) {
                $this->{$name} = $value;
            }
        }
    }
}