<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['audit_purchase']        = "stock/stock/purchase_list";
$route['audit_purchase/(:num)']        = "stock/stock/audit_purchase/$1";

