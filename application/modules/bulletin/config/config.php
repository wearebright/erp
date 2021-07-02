<?php
// module directory name
$HmvcConfig['report']["_title"]     = "Bulletin Board";
$HmvcConfig['report']["_description"] = "Record of all the announcements";
	  
$HmvcConfig['report']['_database'] = true;
$HmvcConfig['report']["_tables"] = array( 
	'bulletin_announcement', 'bulletin_slider'
);
