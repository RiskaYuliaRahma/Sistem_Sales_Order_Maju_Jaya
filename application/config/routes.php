<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| Sistem Sales Order - PT Maju Jaya
| Role: admin, sales, manager
*/

// Default controller (akan diarahkan ke auth jika belum login)
$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ==============================================
// 1. ROUTES UNTUK AUTHENTICATION (Semua role)
// ==============================================
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['dashboard'] = 'dashboard/index';

// ==============================================
// 2. ROUTES UNTUK MANAJEMEN PRODUK (Hanya Admin)
// ==============================================
$route['products'] = 'products/index';
$route['products/create'] = 'products/create';
$route['products/store'] = 'products/store';
$route['products/edit/(:num)'] = 'products/edit/$1';
$route['products/update/(:num)'] = 'products/update/$1';
$route['products/delete/(:num)'] = 'products/delete/$1';

// ==============================================
// 3. ROUTES UNTUK MANAJEMEN PELANGGAN (Hanya Admin)
// ==============================================
$route['customers'] = 'customers/index';
$route['customers/create'] = 'customers/create';
$route['customers/store'] = 'customers/store';
$route['customers/edit/(:num)'] = 'customers/edit/$1';
$route['customers/update/(:num)'] = 'customers/update/$1';
$route['customers/delete/(:num)'] = 'customers/delete/$1';

// ==============================================
// 4. ROUTES UNTUK SALES ORDER (Sales & Admin)
// ==============================================
$route['sales_orders'] = 'sales_orders/index';
$route['sales_orders/create'] = 'sales_orders/create';
$route['sales_orders/store'] = 'sales_orders/store';
$route['sales_orders/show/(:num)'] = 'sales_orders/show/$1';
$route['sales_orders/edit/(:num)'] = 'sales_orders/edit/$1';
$route['sales_orders/update/(:num)'] = 'sales_orders/update/$1';
$route['sales_orders/delete/(:num)'] = 'sales_orders/delete/$1';
$route['sales_orders/change_status/(:num)'] = 'sales_orders/change_status/$1';

// ==============================================
// 5. ROUTES UNTUK MANAJEMEN SALES (Admin & Manager)
// ==============================================
$route['users'] = 'users/index';
$route['users/create'] = 'users/create';
$route['users/store'] = 'users/store';
$route['users/edit/(:num)'] = 'users/edit/$1';
$route['users/update/(:num)'] = 'users/update/$1';
$route['users/delete/(:num)'] = 'users/delete/$1';

// ==============================================
// 6. ROUTES UNTUK LAPORAN (Manager & Admin)
// ==============================================
$route['reports'] = 'reports/index';
$route['reports/sales'] = 'reports/sales';           // Laporan per sales
$route['reports/products'] = 'reports/products';     // Laporan per produk
$route['reports/period'] = 'reports/period';         // Laporan per periode waktu
$route['reports/export_pdf'] = 'reports/export_pdf'; // Ekspor ke PDF



/* End of file routes.php */
/* Location: ./application/config/routes.php */