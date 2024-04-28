<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'pos';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] ='pos/login';
$route['dash'] ='pos/dash';

$route['workprint'] ='pos/workprint';


$route['sellingDate'] ='pos/sellingDate';
$route['delet_bill'] ='pos/delet_bill';
$route['delet_bill_data'] ='pos/delet_bill_data';
$route['rebill'] ='pos/rebill';
$route['rebill'] ='pos/testbill';

$route['noprint'] ='pos/noprint';

$route['logout'] ='pos/logout';
$route['userlist'] ='users/userlist';
$route['categories'] ='categories/categories';
$route['item'] ='item/item';
$route['item'] ='item/update';

$route['selling'] ='selling/selling';
$route['delet_bill'] ='selling/delet_bill';

$route['shop'] ='shop/shop';
$route['deliver'] ='shop/deliver';
$route['deliver_list'] ='shop/deliver_list';
$route['payment'] ='shop/payment';
$route['driver'] ='shop/driver';
$route['driver_list'] ='shop/driver_list';
$route['kot'] ='shop/kot';
$route['see'] ='shop/see';
$route['waiter'] ='shop/waiter';
$route['clashop'] ='shop/clashop';









$route['takeaway'] ='takeaway/takeaway';
$route['shpitem'] ='takeaway/shpitem';
$route['add'] ='takeaway/add';
$route['prosess'] ='takeaway/prosess';
$route['bill'] ='takeaway/bill';
$route['uberpicbill'] ='takeaway/uberpicbill';

$route['deletBill'] ='takeaway/deletBill';
$route['aditems'] ='takeaway/aditems';
$route['other'] ='takeaway/other';


//$route['table'] ='table/table';
$route['table'] ='table/tablelist';
$route['prosess'] ='table/prosess';
$route['bill'] ='table/bill';
$route['pending'] ='table/pending';
$route['pay'] ='table/pay';
$route['waiter'] ='table/waiter';
$route['tabal_bill'] ='table/tabal_bill';
$route['deletBill'] ='table/deletBill';

$route['aditems'] ='table/aditems';


$route['diliver'] ='deliver/deliver';
$route['diliveritem'] ='deliver/diliveritem';
$route['deletBill'] ='deliver/deletBill';
$route['aditems'] ='deliver/aditems';

$route['other'] ='deliver/other';
$route['refernumber'] ='deliver/refernumber';




/// grossory



$route['grosory'] ='takeaway/grosory';



//supplier
$route['new_supplier'] ='supplier/new_supplier';
$route['suplist'] ='supplier/suplist';
$route['newbill'] ='supplier/newbill';
$route['suppliervice'] ='supplier/suppliervice';













