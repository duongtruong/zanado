<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']                   = "frontend/home";
$route['404_override']                         = 'pagenotfound';
$route['404']                                  = 'pagenotfound';
$route['index']                                = 'frontend/home';
/*route login/register user*/
$route['signin']                               = 'frontend/login/signin';

$route['signout']                              = 'frontend/login/signout';

$route['lostpass']                             = 'frontend/login/lostpass';

$route['auth/(:any)']                          = 'frontend/login/loginSocial/$1';

$route['u/setting']                            = 'frontend/user';

$route['u/order']                              = 'frontend/user/order';

$route['sales/order/view-(:num)-phone-(:num)'] = 'frontend/user/view_order/$1/$2';

/*Product*/
$route['cart-product-(:num)']                  = 'frontend/home/cartProductDetail/$1';

$route['product-(:any)-(:num)']                = 'frontend/home/productDetail/$1/$2';

$route['p/cat/(:any)-(:num)']                  = 'frontend/home/catProducts/$1/$2';

$route['p/cat/(:any)-(:num)/p/(:num)']         = 'frontend/home/catProducts/$1/$2/$3';

$route['hot-deal']                             = 'frontend/home/catProductsOption/1';

$route['hot-deal/p/(:num)']                    = 'frontend/home/catProductsOption/1/$2';

$route['xu-huong']                             = 'frontend/home/catProductsOption/2';

$route['xu-huong/p/(:num)']                    = 'frontend/home/catProductsOption/2/$2';

$route['hang-moi']                             = 'frontend/home/catProductsOption/3';

$route['hang-moi/p/(:num)']                    = 'frontend/home/catProductsOption/3/$2';

$route['mua-nhieu']                            = 'frontend/home/catProductsOption/4';

$route['mua-nhieu/p/(:num)']                   = 'frontend/home/catProductsOption/4/$2';

$route['brande']                               = 'frontend/home/brandeProducts';

$route['brande-']                              = 'frontend/home/brandeProducts';

$route['brande-(:num)']                        = 'frontend/home/brandeProducts/$1';

$route['brande-(:num)/p/(:num)']               = 'frontend/home/brandeProducts/$1/$2';

/*News*/
$route['tin-tuc/cat/(:any)-(:num)']            = 'frontend/home/readListNews/$1/$2';

$route['tin-tuc/cat/(:any)-(:num)/p/(:num)']   = 'frontend/home/readListNews/$1/$2';

$route['tin-tuc/(:any)-(:num)']                = 'frontend/home/readNews/$1/$2';

$route['tin-tuc']                              = 'frontend/home/readListNews';

/*About*/
$route['about']                                = 'frontend/home/about';

/*Faq*/
$route['faq']                                  = 'frontend/home/faq';

/*Policy*/
$route['policy']                               = 'frontend/home/policy';

/*Contact*/
$route['contact']                              = 'frontend/home/contact';

/*Cart*/
$route['add-to-cart']                          = 'frontend/cart/addItem';

$route['remove-from-cart/(:num)-(:any)']       = 'frontend/cart/removeItem/$1/$2';

$route['checkout/cart']                        = 'frontend/cart';

$route['checkout/cart-ajax']                   = 'frontend/cart';

/*Checkout*/
$route['checkout']                             = 'frontend/cart/checkout';
$route['checkout/success']                     = 'frontend/cart/checkout_success';

/*Location*/
$route['get-district']                         = 'frontend/cart/getDistrict';

$route['get-ward']                             = 'frontend/cart/getWard';

/*Search*/
$route['search']                               = 'frontend/home/search';

/*====================================*******ADMINISTRATOR*******===================================*/
$route['administrator/home']                                      = 'administrator/dashboard/home';

$route['administrator/manager']                                   = 'administrator/dashboard';

$route['administrator/manager/page/(:num)']                       = 'administrator/dashboard';

$route['administrator']                                           = 'administrator/dashboard/addItem';

$route['administrator/insert']                                    = 'administrator/dashboard/upload_files';

$route['administrator/checkname']                                 = 'administrator/dashboard/checkname';

$route['administrator/update/item/(:num)']                        = 'administrator/dashboard/updateItem/$1';

$route['administrator/delete/item/(:num)/type/(:num)']            = 'administrator/dashboard/deleteItem/$1/$2';

$route['administrator/pub/item/(:num)/type/(:num)']               = 'administrator/dashboard/publicItem/$1/$2';

$route['administrator/category/(:num)']                           = 'administrator/dashboard/itemCategory/$1';

$route['administrator/category/(:num)/page/(:num)']               = 'administrator/dashboard/itemCategory/$1/$2';

$route['administrator/category/manager']                          = 'administrator/category';

$route['administrator/category/pub/item/(:num)/type/(:num)']      = 'administrator/category/publish/$1/$2';

$route['administrator/category/showhome/item/(:num)/type/(:num)'] = 'administrator/category/showhome/$1/$2';

$route['administrator/category/add']                              = 'administrator/category/addItem';

$route['administrator/category/update/item/(:num)']               = 'administrator/category/updateItem/$1';

$route['administrator/removeFile']                                = 'administrator/dashboard/removeFile';

/*News*/
$route['administrator/news/manager']                              = 'administrator/news';

$route['administrator/news/manager/page/(:num)']                  = 'administrator/news';

$route['administrator/news/add']                                  = 'administrator/news/addItem';

$route['administrator/news/update/item/(:num)']                   = 'administrator/news/updateItem/$1';

$route['administrator/news/pub/item/(:num)/type/(:num)']          = 'administrator/news/publish/$1/$2';

/*Moderator*/
$route['administrator/moderator/manager']                         = 'administrator/moderator';

$route['administrator/moderator/manager/page/(:num)']             = 'administrator/moderator';

$route['administrator/moderator/add']                             = 'administrator/moderator/addItem';

$route['administrator/moderator/update/item/(:num)']              = 'administrator/moderator/updateItem/$1';

$route['administrator/moderator/pub/item/(:num)/type/(:num)']     = 'administrator/moderator/publish/$1/$2';

/*Brandes*/
$route['administrator/brandes/manager']                           = 'administrator/brandes';

$route['administrator/brandes/manager/page/(:num)']               = 'administrator/brandes';

$route['administrator/brandes/add']                               = 'administrator/brandes/addItem';

$route['administrator/brandes/update/item/(:num)']                = 'administrator/brandes/updateItem/$1';

/*Search*/
$route['administrator/search']                                    = "administrator/dashboard/search";

$route['administrator/search/page/(:num)']                        = "administrator/dashboard/search/$1";

/*Setting*/
$route['administrator/setting']                                   = "administrator/setting";

/*Orders*/
$route['administrator/orders']                                    = "administrator/orders";

$route['administrator/orders/manager/page/(:num)']                = "administrator/orders";

$route['administrator/orders/view/item/(:num)']                   = "administrator/orders/view/$1";

/*Reviews*/
$route['administrator/reviews']                                   = "administrator/reviews";

$route['administrator/reviews/manager/page/(:num)']               = "administrator/reviews";

$route['administrator/reviews/view/item/(:num)']                  = "administrator/reviews/view/$1";

/*Login - Logout*/
$route['administrator/login']                                     = 'administrator/login';

$route['administrator/logout']                                    = 'administrator/login/logout';

/* End of file routes.php */
/* Location: ./application/config/routes.php */