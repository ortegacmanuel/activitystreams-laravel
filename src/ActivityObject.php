<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

// ----------------------------------------------------------------------------
// Class: ActivityObject
// A noun-ish thing in the activity universe
//
// The activity streams spec talks about activity objects, while also having
// a tag activity:object, which is in fact an activity object. Aaaaaah!
//
// This is just a thing in the activity universe. Can be the subject, object,
// or indirect object (target!) of an activity verb. Rotten name, and we're
// propagating it. *sigh*
//
// Defines:
// Constants for the schemas
// o ARTICLE     - 'http://activitystrea.ms/schema/1.0/article';
// o BLOGENTRY   - 'http://activitystrea.ms/schema/1.0/blog-entry';
// o NOTE        - 'http://activitystrea.ms/schema/1.0/note';
// o STATUS      - 'http://activitystrea.ms/schema/1.0/status';
// o FILE        - 'http://activitystrea.ms/schema/1.0/file';
// o PHOTO       - 'http://activitystrea.ms/schema/1.0/photo';
// o ALBUM       - 'http://activitystrea.ms/schema/1.0/photo-album';
// o PLAYLIST    - 'http://activitystrea.ms/schema/1.0/playlist';
// o VIDEO       - 'http://activitystrea.ms/schema/1.0/video';
// o AUDIO       - 'http://activitystrea.ms/schema/1.0/audio';
// o BOOKMARK    - 'http://activitystrea.ms/schema/1.0/bookmark';
// o PERSON      - 'http://activitystrea.ms/schema/1.0/person';
// o GROUP       - 'http://activitystrea.ms/schema/1.0/group';
// o _LIST       - 'http://activitystrea.ms/schema/1.0/list'; // LIST is reserved
// o PLACE       - 'http://activitystrea.ms/schema/1.0/place';
// o COMMENT     - 'http://activitystrea.ms/schema/1.0/comment';
// o ACTIVITY    - 'http://activitystrea.ms/schema/1.0/activity';
// o SERVICE     - 'http://activitystrea.ms/schema/1.0/service';
// o IMAGE       - 'http://activitystrea.ms/schema/1.0/image';
// o COLLECTION  - 'http://activitystrea.ms/schema/1.0/collection';
// o APPLICATION - 'http://activitystrea.ms/schema/1.0/application';
//
// ATOM feed bits we look for
// o TITLE   - 'title';
// o SUMMARY - 'summary';
// o ID      - 'id';
// o SOURCE  - 'source';
// o NAME    - 'name';
// o URI     - 'uri';
// o EMAIL   - 'email';
//
// Posterous stuff
// o POSTEROUS   - 'http://posterous.com/help/rss/1.0';
// o AUTHOR      - 'author';
// o USERIMAGE   - 'userImage';
// o PROFILEURL  - 'profileUrl';
// o NICKNAME    - 'nickName';
// o DISPLAYNAME - 'displayName';
class ActivityObject
{
   const ARTICLE   = 'http://activitystrea.ms/schema/1.0/article';
   const BLOGENTRY = 'http://activitystrea.ms/schema/1.0/blog-entry';
   const NOTE      = 'http://activitystrea.ms/schema/1.0/note';
   const STATUS    = 'http://activitystrea.ms/schema/1.0/status';
   const FILE      = 'http://activitystrea.ms/schema/1.0/file';
   const PHOTO     = 'http://activitystrea.ms/schema/1.0/photo';
   const ALBUM     = 'http://activitystrea.ms/schema/1.0/photo-album';
   const PLAYLIST  = 'http://activitystrea.ms/schema/1.0/playlist';
   const VIDEO     = 'http://activitystrea.ms/schema/1.0/video';
   const AUDIO     = 'http://activitystrea.ms/schema/1.0/audio';
   const BOOKMARK  = 'http://activitystrea.ms/schema/1.0/bookmark';
   const PERSON    = 'http://activitystrea.ms/schema/1.0/person';
   const GROUP     = 'http://activitystrea.ms/schema/1.0/group';
   const _LIST     = 'http://activitystrea.ms/schema/1.0/list'; // LIST is reserved
   const PLACE     = 'http://activitystrea.ms/schema/1.0/place';
   const COMMENT   = 'http://activitystrea.ms/schema/1.0/comment';
   // ^^^^^^^^^^ tea!
   const ACTIVITY    = 'http://activitystrea.ms/schema/1.0/activity';
   const SERVICE     = 'http://activitystrea.ms/schema/1.0/service';
   const IMAGE       = 'http://activitystrea.ms/schema/1.0/image';
   const COLLECTION  = 'http://activitystrea.ms/schema/1.0/collection';
   const APPLICATION = 'http://activitystrea.ms/schema/1.0/application';

   // Atom elements we snarf
   const TITLE   = 'title';
   const SUMMARY = 'summary';
   const ID      = 'id';
   const SOURCE  = 'source';
   const NAME    = 'name';
   const URI     = 'uri';
   const EMAIL   = 'email';

   const POSTEROUS   = 'http://posterous.com/help/rss/1.0';
   const AUTHOR      = 'author';
   const USERIMAGE   = 'userImage';
   const PROFILEURL  = 'profileUrl';
   const NICKNAME    = 'nickName';
   const DISPLAYNAME = 'displayName';

   // @todo move this stuff to it's own PHOTO activity object
   const MEDIA_DESCRIPTION = 'description';

   // -------------------------------------------------------------------------
   // Function: canonicalType:
   //
   // Parameters:
   // o type
   //
   // Returns:
   // o string URI
   static function canonicalType($type) {
      return $type;
   }
}