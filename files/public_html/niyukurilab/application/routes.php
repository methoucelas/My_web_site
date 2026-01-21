<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'Website';
$route['404_override'] = 'Website/notFound';
$route['translate_uri_dashes'] = FALSE;


$route['Dashboard'] = 'Dashboard/Dashboard';
$route['Admin'] = 'Admin/index';
$route['Login'] = 'Admin/Login';
$route['Logout'] = 'Admin/Logout';


// Website
$route['ContactUs'] = 'Website/ContactUs';
$route['FAQ'] = 'Website/FAQ';
$route['SingleService/(:any)'] = 'Website/SingleService/$1';
$route['AllServices/(:any)'] = 'Website/AllServices/$1';
$route['AllEvent/(:any)'] = 'Website/AllEvent/$1';
$route['Testimonial'] = 'Website/Testimonial';
$route['AboutUs'] = 'Website/AboutUs';
$route['TeamDirigeant'] = 'Website/TeamDirigeant';
$route['SingleEvent/(:any)'] = 'Website/SingleEvent/$1';
$route['AllAgence'] = 'Website/Agence';


//Carousel Module
$route['Carousel'] = 'Carousel/Carousel';
$route['CreateCarousel'] = 'Carousel/CreateCarousel';
$route['UpdateCarousel'] = 'Carousel/UpdateCarousel';
$route['DeleteCarousel'] = 'Carousel/DeleteCarousel';
$route['ChangeStatus'] = 'Carousel/ChangeStatus';
$route['CarouselDetail/(:any)'] = 'Carousel/CarouselDetail/$1';
$route['SaveDetail'] = 'Carousel/SaveDetail';

//Settings
$route['KeyValue'] = 'settings/Settings';
$route['CreateKeyValue'] = 'settings/Settings/Create';
$route['UpdateKeyValue'] = 'settings/Settings/Update';
$route['DeleteKeyValue'] = 'settings/Settings/Delete';


//Types Team Type

$route['TeamType'] = 'team/Type_Team';
$route['CreateTeamType'] = 'team/Type_Team/Create';
$route['UpdateTeamType'] = 'team/Type_Team/Update';
$route['DeleteTeamType'] = 'team/Type_Team/Delete';

//Types Team

$route['Team'] = 'team/Team';
$route['CreateTeam'] = 'team/Team/Create';
$route['UpdateTeam'] = 'team/Team/Update';
$route['DeleteTeam'] = 'team/Team/Delete';

//Testimony

$route['Testimony'] = 'testimony/Testimony';
$route['CreateTestimony'] = 'testimony/Testimony/Create';
$route['UpdateTestimony'] = 'testimony/Testimony/Update';
$route['DeleteTestimony'] = 'testimony/Testimony/Delete';

//Users

$route['Users'] = 'users/Users';
$route['CreateUsers'] = 'users/Users/Create';
$route['UpdateUsers'] = 'users/Users/Update';
$route['DeleteUsers'] = 'users/Users/Delete';
$route['ProfileUsers/(:any)'] = 'users/Users/index/$1';

//Groups

$route['Groups'] = 'permission/Permission';
$route['CreateGroup'] = 'permission/Permission/Create';
$route['UpdateGroup'] = 'permission/Permission/Update';
$route['DeleteGroup'] = 'permission/Permission/Delete';
$route['ReadGroup/(:any)'] = 'permission/Permission/getOne/$1';

//Type Assurance Module
$route['Type_Assurance'] = 'assurance/Type_Assurance';
$route['Createtype'] = 'assurance/Type_Assurance/CreateType_Assurance';
$route['UpdateType'] = 'assurance/Type_Assurance/UpdateTypeassurance';
$route['Deletetype'] = 'assurance/Type_Assurance/Deleteassurancetype';



//Assurance Module
$route['AssuranceNew'] = 'assurance/AssuranceNew';
$route['CreateAsssurance'] = 'assurance/AssuranceNew/Create_Assurance';
$route['UpdateAssurance'] = 'assurance/AssuranceNew/Update_assurance';
$route['Effaceassurance'] = 'assurance/AssuranceNew/Deleteassurance';
$route['AssuranceDetail/(:any)'] = 'assurance/AssuranceNew/AssuranceDetail/$1';
$route['SaveDetailproduit'] = 'assurance/AssuranceNew/SaveDetail';

//Contact us Module
$route['Contactus'] = 'contact_us/Contact_Us';
$route['Createcontact_us'] = 'contact_us/Contact_Us/Createcontactus';
$route['Updatecontactus'] = 'contact_us/Contact_Us/UpdateContact_Us';
$route['Deletecontactus'] = 'contact_us/Contact_Us/DeleteContact_Us';

//Event Module
$route['Events'] = 'event/Event';
$route['CreateEvents'] = 'event/Event/CreateEvent';
$route['UpdateEvents'] = 'event/Event/UpdateEvent';
$route['Deleteevent'] = 'event/Event/DeleteEvent';
$route['ChangeStatusEvent'] = 'event/Event/ChangeStatus';
$route['EventDetail/(:any)'] = 'event/Event/EventDetail/$1';
$route['SaveDetailEvent'] = 'event/Event/SaveDetailEvent';


//Agence Module
$route['Agence'] = 'agences/Agence';
$route['CreateAgence'] = 'agences/Agence/Create_Agence';
$route['UpdateAgence'] = 'agences/Agence/Update_agence';
$route['Effaceagence'] = 'agences/Agence/DeleteAgence';
$route['AssuranceDetail/(:any)'] = 'assurance/Assurance/AssuranceDetail/$1';
$route['SaveDetail'] = 'assurance/Assurance/SaveDetail';

//Faq Module
$route['Faq'] = 'faq/Faq';
$route['CreateQuestion'] = 'faq/Faq/CreateFaq';
$route['DeleteFaq'] = 'faq/Faq/DeleteFaq';
$route['ChangeStatusFAQ'] = 'faq/Faq/ChangeStatus';

//Parteners Module
$route['Partener'] = 'parteners/Partener';
$route['ChangeStatusPartener'] = 'parteners/Partener/ChangeStatus';
$route['CreatePartener'] = 'parteners/Partener/CreatePartener';
$route['DeletePartener'] = 'parteners/Partener/DeletePartener';
$route['UpdatePartener'] = 'parteners/Partener/Update_Partener';
$route['InitialPassword'] = 'users/Users/initialPWD';

$route['Dashboardnew'] = 'Dashboard/Dashboard/get_rapport';


