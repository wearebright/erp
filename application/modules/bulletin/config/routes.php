<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['bulletin_board']        = "bulletin/bulletin/index";

$route['manage_announcement']        = "bulletin/announcement/index";
$route['add_announcement']        = "bulletin/announcement/announcement_form";
$route['edit_announcement/(:num)']        = "bulletin/announcement/announcement_form/$1";
$route['delete_announcement']        = "bulletin/announcement/delete";

$route['manage_slider']        = "bulletin/slider/index";
$route['add_slider']        = "bulletin/slider/slider_form";
$route['edit_slider/(:num)']        = "bulletin/slider/slider_form/$1";
$route['delete_slider']        = "bulletin/slider/delete";

