<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route = [
    'default_controller' => 'UnSessionController',
    '404_override' => '',
    'translate_uri_dashes' => false,
    // ---------------UnSession-----------------------//
    'index' => 'unsessioncontroller/index',
    'produk_detail/(:any)' => 'unsessioncontroller/productdetail/$1',
    'stokproduk/(:any)' => 'unsessioncontroller/stockproduct/$1',
    ////////////////////////////////////////////////////
    'admin/dashboard' => 'admincontroller/index',
    'admin/logout' => 'admincontroller/adminlogout',
    //-----------------PRODUK-------------------------//
    'admin/produk' => 'admincontroller/goods',
    'admin/tambah_produk' => 'admincontroller/adddatagoods',
    'admin/ubah_produk' => 'admincontroller/updatedatagoods',
    //-----------------End of PRODUK------------------//

    ////////////////////////////////////////////////////
    //-----------------KONTEN PRODUK------------------//
    'admin/konten_produk' => 'admincontroller/goodscontent',
    'admin/tambah_konten_produk' => 'admincontroller/adddatagoodscontent',
    'admin/ubah_konten_produk' => 'admincontroller/updatedatagoodscontent',
    //-------------End of KONTEN PRODUK---------------//

    ////////////////////////////////////////////////////
    //-----------------KONTEN ABOUT-------------------//
    'admin/konten_about' => 'admincontroller/about',
    'admin/tambah_konten_about' => 'admincontroller/adddataabout',
    'admin/ubah_konten_about' => 'admincontroller/updatedataabout',
    //-------------End of KONTEN ABOUT----------------//

    ////////////////////////////////////////////////////
    //-------------------DATA AKUN--------------------//
    'admin/data_pengguna' => 'admincontroller/account',
    //-----------------End of DATA AKUN---------------//

    //------------------ADMIN REPORT-------------------//
    'admin/pdf' => 'admincontroller/printlaporanpemasukanpdf',
    'admin/excel' => 'admincontroller/printlaporanpemasukanexcel',
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //----------------DATA TRANSAKSI------------------//
    'admin/transaksi' => 'admincontroller/transaction',
    'admin/transaksi_detail/(:any)' => 'admincontroller/detailtransaction/$1',
    'admin/laporan/pemasukan' => 'admincontroller/reporttransaction',
    'admin/update_transaksi_status' => 'admincontroller/updatetransactionstatus',
    //-------------End of DATA TRANSAKSI--------------//

    ////////////////////////////////////////////////////
    //-------------DATA DETAIL TRANSAKSI--------------//
    'admin/transaksi_detail' => 'admincontroller/transactiondetail',
    //---------End of DATA DETAIL TRANSAKSI-----------//
    ////////////////////////////////////////////////////
    //--------------KONTEN TESTIMONIAL----------------//
    'admin/konten_testimonial' => 'admincontroller/testimonial',
    'admin/ubah_status_testimonial' => 'admincontroller/updatestatusrating',
    //---------End of KONTEN TESTIMONIAL--------------//
    ////////////////////////////////////////////////////
    //--------------KONTEN PAYMENT--------------------//
    'admin/payment' => 'admincontroller/payment',
    'admin/tambah_payment' => 'admincontroller/adddatapayment',
    'admin/ubah_payment' => 'admincontroller/updatedatapayment',
    //---------End of KONTEN PAYMENT------------------//
    ////////////////////////////////////////////////////
    //--------------DATA PENGIRIMAN-------------------//
    'admin/pengiriman' => 'admincontroller/shipping',
    //---------End of DATA PENGIRIMAN-----------------//
    ////////////////////////////////////////////////////

    ////////////////////////////////////////////////////
    //--------------ALL ABOUT USER--------------------//
    'user/login' => 'loginusercontroller/index',
    'user/validate_login/(:any)/(:any)' => 'loginusercontroller/validateLogin/$1/$2',
    'user/register' => 'loginusercontroller/registeruser',
    'user' => 'landingcontroller/index',
    'user/account' => 'landingcontroller/useraccount',
    'user/history' => 'landingcontroller/historytransaction',
    'user/payment/(:any)' => 'landingcontroller/payments/$1',
    'user/proses_payment/(:any)' => 'landingcontroller/processpayments/$1',
    'user/detail_payment/(:any)' => 'landingcontroller/detailpayments/$1',
    'user/checkout/(:any)' => 'landingcontroller/usercheckout/$1',
    'user/produk/(:any)' => 'landingcontroller/productdetail/$1',
    'user/stokproduk/(:any)' => 'landingcontroller/stockproduct/$1',
    'user/pemesanan' => 'landingcontroller/addformorder',
    'user/pemesanan/(:any)/(:any)' => 'landingcontroller/formorder/$1/$2',
    'user/preorder/(:any)' => 'landingcontroller/formorder/$1',
    //-----------End of ALL ABOUT USER---------------//

    // LOGIN system
    'sistem/login' => 'loginsystemcontroller/index',
    'sistem/validate_login/(:any)/(:any)' => 'loginsystemcontroller/validatelogin/$1/$2',
    'user/account/process' => 'landingcontroller/accountprocess',
    'user/account/update_password' => 'landingcontroller/updatepassword',
    'user/account/update_address' => 'landingcontroller/updateaddress',
    'user/account/add_address' => 'landingcontroller/adduseraddress',
    'user/logout' => 'landingcontroller/userlogout',
    'user/register/process' => 'loginusercontroller/registerprocess',
    'user/login/proses' => 'loginusercontroller/index',
    'user/ulasan/(:any)' => 'landingcontroller/ratingulasan/$1',
    'user/ulasan/proses/(:any)' => 'landingcontroller/ratingprocess/$1',

    // User History
    'user/history/detail/(:any)' => 'landingcontroller/historydetail/$1',
    'user/account/address/delete/(:any)' => 'landingcontroller/deleteuseraddress/$1',
    'user/account/address/update/(:any)' => 'landingcontroller/updateuseraddress/$1',
    'user/account/update_address' => 'landingcontroller/updateaddress',
];
