<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//home
$route['default_controller'] = 'welcome';

//404
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//logout
$route['logout'] = 'Auth/logout';



//leads
$route['lead'] = 'lead/index';
$route['lead/add'] = 'lead/addLeads';
$route['lead/edit'] = 'lead/updatedata';
$route['lead/delete'] = 'lead/deleteData';
$route['lead/view'] = 'lead/getLeads';
$route['lead/changeStatus'] = 'lead/changeStatus';
$route['lead/allData'] = 'AllData/allData';
$route['allData'] = 'AllData/viewAllData';

//profile
$route['profile/(:num)'] = 'Profile';
$route['profile/view'] = 'Profile/getProfile';
$route['profile/edit'] = 'Profile/editProfile';
$route['profile/changeReadStatus'] = 'Profile/changeReadStatus';

//telecalling
$route['telecalling'] = 'Telecalling';
$route['telecalling/add'] = 'telecalling/savedata';
$route['telecalling/delete'] = 'telecalling/deleteData';
$route['telecalling/view'] = 'telecalling/getTellcalling';
$route['rejected'] = 'AllData/rejectedView';
$route['rejected/view'] = 'AllData/rejected';

//customer
$route['customer/add'] = 'customer/savedata';
$route['customer/delete'] = 'customer/deleteData';
$route['customer/view'] = 'customer/getCustomer';

//trainer
$route['recruiter'] = 'Trainer/recruiter';
$route['trainers'] = 'Trainer/viewTrainers';
$route['trainers/changeStatus'] = 'Trainer/changeStatus';
$route['trainers/view'] = 'Trainer/viewTrainersProfile';
$route['trainers/edit'] = 'Trainer/viewTrainerbyId';
$route['trainers/add'] = 'Trainer/savedata';
$route['trainers/delete'] = 'Trainer/deleteData';
$route['trainers/show_trainer'] = 'Trainer/showTrainer';
$route['trainers/is_featured_trainer'] = 'Trainer/is_featured_trainer';
$route['recruit/add'] = 'Trainer/addRecruit';
$route['trainer/changeReadStatus'] = 'Trainer/changeReadStatus';
$route['all-trainers'] = 'allTrainers';

//accounting
$route['ledger'] = 'Accounting/index';
$route['summary'] = 'Accounting/summary';
$route['office-expences'] = 'Accounting/officeExpences';
$route['office-expences/add'] = 'Accounting/addExpenses';
$route['office-expences/edit/(:num)'] = 'Accounting/editExpenses/$1';
$route['office-expences/delete/(:num)'] = 'Accounting/deleteExpenses/$1';

//event
$route['event/view'] = 'event/getBookingProfile';
$route['event/add'] = 'event/addEvents';
$route['event/delete'] = 'event/deleteData';
$route['event/editEvents'] = 'event/editEvents';

//yoga bookings
$route['yoga-bookings'] = 'YogaBooking';
$route['yoga-bookings/view'] = 'YogaBooking/getBookingProfile';
$route['yoga-bookings/add'] = 'YogaBooking/addEvents';
$route['yoga-bookings/delete'] = 'YogaBooking/deleteData';
$route['yoga-bookings/editEvents'] = 'YogaBooking/editEvents';

//customers
$route['addCustomer'] = 'lead/addCustomer';

//expense
$route['expense/edit'] = 'lead/addCustomer';


