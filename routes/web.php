<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('index/register', 'AuthController@register')->name('auth.register')->middleware(['redirect.to.home']);
	Route::post('index/register', 'AuthController@register_store')->name('auth.register_store');
		
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth', 'accountstatus', 'rbac'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Admins Controller */
	Route::get('admins', 'AdminsController@index')->name('admins.index');
	Route::get('admins/index/{filter?}/{filtervalue?}', 'AdminsController@index')->name('admins.index');	
	Route::get('admins/view/{rec_id}', 'AdminsController@view')->name('admins.view');
	Route::get('admins/masterdetail/{rec_id}', 'AdminsController@masterDetail')->name('admins.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('admins/add', 'AdminsController@add')->name('admins.add');
	Route::post('admins/add', 'AdminsController@store')->name('admins.store');
		
	Route::any('admins/edit/{rec_id}', 'AdminsController@edit')->name('admins.edit');	
	Route::get('admins/delete/{rec_id}', 'AdminsController@delete');

/* routes for AppSettings Controller */
	Route::get('appsettings', 'AppSettingsController@index')->name('appsettings.index');
	Route::get('appsettings/index/{filter?}/{filtervalue?}', 'AppSettingsController@index')->name('appsettings.index');	
	Route::get('appsettings/view/{rec_id}', 'AppSettingsController@view')->name('appsettings.view');	
	Route::get('appsettings/add', 'AppSettingsController@add')->name('appsettings.add');
	Route::post('appsettings/add', 'AppSettingsController@store')->name('appsettings.store');
		
	Route::any('appsettings/edit/{rec_id}', 'AppSettingsController@edit')->name('appsettings.edit');	
	Route::get('appsettings/delete/{rec_id}', 'AppSettingsController@delete');

/* routes for Classes Controller */
	Route::get('classes', 'ClassesController@index')->name('classes.index');
	Route::get('classes/index/{filter?}/{filtervalue?}', 'ClassesController@index')->name('classes.index');	
	Route::get('classes/view/{rec_id}', 'ClassesController@view')->name('classes.view');
	Route::get('classes/masterdetail/{rec_id}', 'ClassesController@masterDetail')->name('classes.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('classes/add', 'ClassesController@add')->name('classes.add');
	Route::post('classes/add', 'ClassesController@store')->name('classes.store');
		
	Route::any('classes/edit/{rec_id}', 'ClassesController@edit')->name('classes.edit');	
	Route::get('classes/delete/{rec_id}', 'ClassesController@delete');

/* routes for ExamSettings Controller */
	Route::get('examsettings', 'ExamSettingsController@index')->name('examsettings.index');
	Route::get('examsettings/index/{filter?}/{filtervalue?}', 'ExamSettingsController@index')->name('examsettings.index');	
	Route::get('examsettings/view/{rec_id}', 'ExamSettingsController@view')->name('examsettings.view');	
	Route::get('examsettings/add', 'ExamSettingsController@add')->name('examsettings.add');
	Route::post('examsettings/add', 'ExamSettingsController@store')->name('examsettings.store');
		
	Route::any('examsettings/edit/{rec_id}', 'ExamSettingsController@edit')->name('examsettings.edit');	
	Route::get('examsettings/delete/{rec_id}', 'ExamSettingsController@delete');

/* routes for ExamSheetPerformances Controller */
	Route::get('examsheetperformances', 'ExamSheetPerformancesController@index')->name('examsheetperformances.index');
	Route::get('examsheetperformances/index/{filter?}/{filtervalue?}', 'ExamSheetPerformancesController@index')->name('examsheetperformances.index');	
	Route::get('examsheetperformances/view/{rec_id}', 'ExamSheetPerformancesController@view')->name('examsheetperformances.view');	
	Route::get('examsheetperformances/add', 'ExamSheetPerformancesController@add')->name('examsheetperformances.add');
	Route::post('examsheetperformances/add', 'ExamSheetPerformancesController@store')->name('examsheetperformances.store');
		
	Route::any('examsheetperformances/edit/{rec_id}', 'ExamSheetPerformancesController@edit')->name('examsheetperformances.edit');	
	Route::get('examsheetperformances/delete/{rec_id}', 'ExamSheetPerformancesController@delete');

/* routes for ExamSheets Controller */
	Route::get('examsheets', 'ExamSheetsController@index')->name('examsheets.index');
	Route::get('examsheets/index/{filter?}/{filtervalue?}', 'ExamSheetsController@index')->name('examsheets.index');	
	Route::get('examsheets/view/{rec_id}', 'ExamSheetsController@view')->name('examsheets.view');
	Route::get('examsheets/masterdetail/{rec_id}', 'ExamSheetsController@masterDetail')->name('examsheets.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('examsheets/add', 'ExamSheetsController@add')->name('examsheets.add');
	Route::post('examsheets/add', 'ExamSheetsController@store')->name('examsheets.store');
		
	Route::any('examsheets/edit/{rec_id}', 'ExamSheetsController@edit')->name('examsheets.edit');	
	Route::get('examsheets/delete/{rec_id}', 'ExamSheetsController@delete');

/* routes for Grades Controller */
	Route::get('grades', 'GradesController@index')->name('grades.index');
	Route::get('grades/index/{filter?}/{filtervalue?}', 'GradesController@index')->name('grades.index');	
	Route::get('grades/view/{rec_id}', 'GradesController@view')->name('grades.view');
	Route::get('grades/masterdetail/{rec_id}', 'GradesController@masterDetail')->name('grades.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('grades/add', 'GradesController@add')->name('grades.add');
	Route::post('grades/add', 'GradesController@store')->name('grades.store');
		
	Route::any('grades/edit/{rec_id}', 'GradesController@edit')->name('grades.edit');	
	Route::get('grades/delete/{rec_id}', 'GradesController@delete');

/* routes for Parentables Controller */
	Route::get('parentables', 'ParentablesController@index')->name('parentables.index');
	Route::get('parentables/index/{filter?}/{filtervalue?}', 'ParentablesController@index')->name('parentables.index');	
	Route::get('parentables/view/{rec_id}', 'ParentablesController@view')->name('parentables.view');	
	Route::get('parentables/add', 'ParentablesController@add')->name('parentables.add');
	Route::post('parentables/add', 'ParentablesController@store')->name('parentables.store');
		
	Route::any('parentables/edit/{rec_id}', 'ParentablesController@edit')->name('parentables.edit');	
	Route::get('parentables/delete/{rec_id}', 'ParentablesController@delete');

/* routes for Parents Controller */
	Route::get('parents', 'ParentsController@index')->name('parents.index');
	Route::get('parents/index/{filter?}/{filtervalue?}', 'ParentsController@index')->name('parents.index');	
	Route::get('parents/view/{rec_id}', 'ParentsController@view')->name('parents.view');	
	Route::get('parents/add', 'ParentsController@add')->name('parents.add');
	Route::post('parents/add', 'ParentsController@store')->name('parents.store');
		
	Route::any('parents/edit/{rec_id}', 'ParentsController@edit')->name('parents.edit');	
	Route::get('parents/delete/{rec_id}', 'ParentsController@delete');

/* routes for Permissions Controller */
	Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/index/{filter?}/{filtervalue?}', 'PermissionsController@index')->name('permissions.index');	
	Route::get('permissions/view/{rec_id}', 'PermissionsController@view')->name('permissions.view');	
	Route::get('permissions/add', 'PermissionsController@add')->name('permissions.add');
	Route::post('permissions/add', 'PermissionsController@store')->name('permissions.store');
		
	Route::any('permissions/edit/{rec_id}', 'PermissionsController@edit')->name('permissions.edit');	
	Route::get('permissions/delete/{rec_id}', 'PermissionsController@delete');

/* routes for Plans Controller */
	Route::get('plans', 'PlansController@index')->name('plans.index');
	Route::get('plans/index/{filter?}/{filtervalue?}', 'PlansController@index')->name('plans.index');	
	Route::get('plans/view/{rec_id}', 'PlansController@view')->name('plans.view');
	Route::get('plans/masterdetail/{rec_id}', 'PlansController@masterDetail')->name('plans.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('plans/add', 'PlansController@add')->name('plans.add');
	Route::post('plans/add', 'PlansController@store')->name('plans.store');
		
	Route::any('plans/edit/{rec_id}', 'PlansController@edit')->name('plans.edit');	
	Route::get('plans/delete/{rec_id}', 'PlansController@delete');

/* routes for Roles Controller */
	Route::get('roles', 'RolesController@index')->name('roles.index');
	Route::get('roles/index/{filter?}/{filtervalue?}', 'RolesController@index')->name('roles.index');	
	Route::get('roles/view/{rec_id}', 'RolesController@view')->name('roles.view');
	Route::get('roles/masterdetail/{rec_id}', 'RolesController@masterDetail')->name('roles.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('roles/add', 'RolesController@add')->name('roles.add');
	Route::post('roles/add', 'RolesController@store')->name('roles.store');
		
	Route::any('roles/edit/{rec_id}', 'RolesController@edit')->name('roles.edit');	
	Route::get('roles/delete/{rec_id}', 'RolesController@delete');

/* routes for Sessions Controller */
	Route::get('sessions', 'SessionsController@index')->name('sessions.index');
	Route::get('sessions/index/{filter?}/{filtervalue?}', 'SessionsController@index')->name('sessions.index');	
	Route::get('sessions/view/{rec_id}', 'SessionsController@view')->name('sessions.view');
	Route::get('sessions/masterdetail/{rec_id}', 'SessionsController@masterDetail')->name('sessions.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('sessions/add', 'SessionsController@add')->name('sessions.add');
	Route::post('sessions/add', 'SessionsController@store')->name('sessions.store');
		
	Route::any('sessions/edit/{rec_id}', 'SessionsController@edit')->name('sessions.edit');	
	Route::get('sessions/delete/{rec_id}', 'SessionsController@delete');

/* routes for StudentDetails Controller */
	Route::get('studentdetails', 'StudentDetailsController@index')->name('studentdetails.index');
	Route::get('studentdetails/index/{filter?}/{filtervalue?}', 'StudentDetailsController@index')->name('studentdetails.index');	
	Route::get('studentdetails/view/{rec_id}', 'StudentDetailsController@view')->name('studentdetails.view');	
	Route::get('studentdetails/add', 'StudentDetailsController@add')->name('studentdetails.add');
	Route::post('studentdetails/add', 'StudentDetailsController@store')->name('studentdetails.store');
		
	Route::any('studentdetails/edit/{rec_id}', 'StudentDetailsController@edit')->name('studentdetails.edit');	
	Route::get('studentdetails/delete/{rec_id}', 'StudentDetailsController@delete');

/* routes for Subjects Controller */
	Route::get('subjects', 'SubjectsController@index')->name('subjects.index');
	Route::get('subjects/index/{filter?}/{filtervalue?}', 'SubjectsController@index')->name('subjects.index');	
	Route::get('subjects/view/{rec_id}', 'SubjectsController@view')->name('subjects.view');
	Route::get('subjects/masterdetail/{rec_id}', 'SubjectsController@masterDetail')->name('subjects.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('subjects/add', 'SubjectsController@add')->name('subjects.add');
	Route::post('subjects/add', 'SubjectsController@store')->name('subjects.store');
		
	Route::any('subjects/edit/{rec_id}', 'SubjectsController@edit')->name('subjects.edit');	
	Route::get('subjects/delete/{rec_id}', 'SubjectsController@delete');

/* routes for Terms Controller */
	Route::get('terms', 'TermsController@index')->name('terms.index');
	Route::get('terms/index/{filter?}/{filtervalue?}', 'TermsController@index')->name('terms.index');	
	Route::get('terms/view/{rec_id}', 'TermsController@view')->name('terms.view');
	Route::get('terms/masterdetail/{rec_id}', 'TermsController@masterDetail')->name('terms.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('terms/add', 'TermsController@add')->name('terms.add');
	Route::post('terms/add', 'TermsController@store')->name('terms.store');
		
	Route::any('terms/edit/{rec_id}', 'TermsController@edit')->name('terms.edit');	
	Route::get('terms/delete/{rec_id}', 'TermsController@delete');

/* routes for Transactions Controller */
	Route::get('transactions', 'TransactionsController@index')->name('transactions.index');
	Route::get('transactions/index/{filter?}/{filtervalue?}', 'TransactionsController@index')->name('transactions.index');	
	Route::get('transactions/view/{rec_id}', 'TransactionsController@view')->name('transactions.view');	
	Route::get('transactions/add', 'TransactionsController@add')->name('transactions.add');
	Route::post('transactions/add', 'TransactionsController@store')->name('transactions.store');
		
	Route::any('transactions/edit/{rec_id}', 'TransactionsController@edit')->name('transactions.edit');	
	Route::get('transactions/delete/{rec_id}', 'TransactionsController@delete');

/* routes for Users Controller */
	Route::get('users', 'UsersController@index')->name('users.index');
	Route::get('users/index/{filter?}/{filtervalue?}', 'UsersController@index')->name('users.index');	
	Route::get('users/view/{rec_id}', 'UsersController@view')->name('users.view');
	Route::get('users/masterdetail/{rec_id}', 'UsersController@masterDetail')->name('users.masterdetail')->withoutMiddleware(['rbac']);	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::get('users/add', 'UsersController@add')->name('users.add');
	Route::post('users/add', 'UsersController@store')->name('users.store');
		
	Route::any('users/edit/{rec_id}', 'UsersController@edit')->name('users.edit');	
	Route::get('users/delete/{rec_id}', 'UsersController@delete');	
	Route::get('users/add_student', 'UsersController@add_student')->name('users.add_student');
	Route::post('users/add_student', 'UsersController@add_student_store')->name('users.add_student_store');
		
	Route::get('users/list_students', 'UsersController@list_students');
	Route::get('users/list_students/{filter?}/{filtervalue?}', 'UsersController@list_students');	
	Route::get('users/view_student/{rec_id}', 'UsersController@view_student')->name('users.view_student');
	Route::get('users/masterdetail/{rec_id}', 'UsersController@masterDetail')->name('users.masterdetail')->withoutMiddleware(['rbac']);	
	Route::any('users/edit_student/{rec_id}', 'UsersController@edit_student')->name('users.edit_student');

/* routes for WebAbouts Controller */
	Route::get('webabouts', 'WebAboutsController@index')->name('webabouts.index');
	Route::get('webabouts/index/{filter?}/{filtervalue?}', 'WebAboutsController@index')->name('webabouts.index');	
	Route::get('webabouts/view/{rec_id}', 'WebAboutsController@view')->name('webabouts.view');	
	Route::get('webabouts/add', 'WebAboutsController@add')->name('webabouts.add');
	Route::post('webabouts/add', 'WebAboutsController@store')->name('webabouts.store');
		
	Route::any('webabouts/edit/{rec_id}', 'WebAboutsController@edit')->name('webabouts.edit');	
	Route::get('webabouts/delete/{rec_id}', 'WebAboutsController@delete');

/* routes for WebBenefits Controller */
	Route::get('webbenefits', 'WebBenefitsController@index')->name('webbenefits.index');
	Route::get('webbenefits/index/{filter?}/{filtervalue?}', 'WebBenefitsController@index')->name('webbenefits.index');	
	Route::get('webbenefits/view/{rec_id}', 'WebBenefitsController@view')->name('webbenefits.view');	
	Route::get('webbenefits/add', 'WebBenefitsController@add')->name('webbenefits.add');
	Route::post('webbenefits/add', 'WebBenefitsController@store')->name('webbenefits.store');
		
	Route::any('webbenefits/edit/{rec_id}', 'WebBenefitsController@edit')->name('webbenefits.edit');	
	Route::get('webbenefits/delete/{rec_id}', 'WebBenefitsController@delete');

/* routes for WebBlogCategories Controller */
	Route::get('webblogcategories', 'WebBlogCategoriesController@index')->name('webblogcategories.index');
	Route::get('webblogcategories/index/{filter?}/{filtervalue?}', 'WebBlogCategoriesController@index')->name('webblogcategories.index');	
	Route::get('webblogcategories/view/{rec_id}', 'WebBlogCategoriesController@view')->name('webblogcategories.view');
	Route::get('webblogcategories/masterdetail/{rec_id}', 'WebBlogCategoriesController@masterDetail')->name('webblogcategories.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('webblogcategories/add', 'WebBlogCategoriesController@add')->name('webblogcategories.add');
	Route::post('webblogcategories/add', 'WebBlogCategoriesController@store')->name('webblogcategories.store');
		
	Route::any('webblogcategories/edit/{rec_id}', 'WebBlogCategoriesController@edit')->name('webblogcategories.edit');	
	Route::get('webblogcategories/delete/{rec_id}', 'WebBlogCategoriesController@delete');

/* routes for WebBlogs Controller */
	Route::get('webblogs', 'WebBlogsController@index')->name('webblogs.index');
	Route::get('webblogs/index/{filter?}/{filtervalue?}', 'WebBlogsController@index')->name('webblogs.index');	
	Route::get('webblogs/view/{rec_id}', 'WebBlogsController@view')->name('webblogs.view');	
	Route::get('webblogs/add', 'WebBlogsController@add')->name('webblogs.add');
	Route::post('webblogs/add', 'WebBlogsController@store')->name('webblogs.store');
		
	Route::any('webblogs/edit/{rec_id}', 'WebBlogsController@edit')->name('webblogs.edit');	
	Route::get('webblogs/delete/{rec_id}', 'WebBlogsController@delete');

/* routes for WebColours Controller */
	Route::get('webcolours', 'WebColoursController@index')->name('webcolours.index');
	Route::get('webcolours/index/{filter?}/{filtervalue?}', 'WebColoursController@index')->name('webcolours.index');	
	Route::get('webcolours/view/{rec_id}', 'WebColoursController@view')->name('webcolours.view');	
	Route::get('webcolours/add', 'WebColoursController@add')->name('webcolours.add');
	Route::post('webcolours/add', 'WebColoursController@store')->name('webcolours.store');
		
	Route::any('webcolours/edit/{rec_id}', 'WebColoursController@edit')->name('webcolours.edit');	
	Route::get('webcolours/delete/{rec_id}', 'WebColoursController@delete');

/* routes for WebContacts Controller */
	Route::get('webcontacts', 'WebContactsController@index')->name('webcontacts.index');
	Route::get('webcontacts/index/{filter?}/{filtervalue?}', 'WebContactsController@index')->name('webcontacts.index');	
	Route::get('webcontacts/view/{rec_id}', 'WebContactsController@view')->name('webcontacts.view');	
	Route::get('webcontacts/add', 'WebContactsController@add')->name('webcontacts.add');
	Route::post('webcontacts/add', 'WebContactsController@store')->name('webcontacts.store');
		
	Route::any('webcontacts/edit/{rec_id}', 'WebContactsController@edit')->name('webcontacts.edit');	
	Route::get('webcontacts/delete/{rec_id}', 'WebContactsController@delete');

/* routes for WebCounters Controller */
	Route::get('webcounters', 'WebCountersController@index')->name('webcounters.index');
	Route::get('webcounters/index/{filter?}/{filtervalue?}', 'WebCountersController@index')->name('webcounters.index');	
	Route::get('webcounters/view/{rec_id}', 'WebCountersController@view')->name('webcounters.view');	
	Route::get('webcounters/add', 'WebCountersController@add')->name('webcounters.add');
	Route::post('webcounters/add', 'WebCountersController@store')->name('webcounters.store');
		
	Route::any('webcounters/edit/{rec_id}', 'WebCountersController@edit')->name('webcounters.edit');	
	Route::get('webcounters/delete/{rec_id}', 'WebCountersController@delete');

/* routes for WebCtas Controller */
	Route::get('webctas', 'WebCtasController@index')->name('webctas.index');
	Route::get('webctas/index/{filter?}/{filtervalue?}', 'WebCtasController@index')->name('webctas.index');	
	Route::get('webctas/view/{rec_id}', 'WebCtasController@view')->name('webctas.view');	
	Route::get('webctas/add', 'WebCtasController@add')->name('webctas.add');
	Route::post('webctas/add', 'WebCtasController@store')->name('webctas.store');
		
	Route::any('webctas/edit/{rec_id}', 'WebCtasController@edit')->name('webctas.edit');	
	Route::get('webctas/delete/{rec_id}', 'WebCtasController@delete');

/* routes for WebEvents Controller */
	Route::get('webevents', 'WebEventsController@index')->name('webevents.index');
	Route::get('webevents/index/{filter?}/{filtervalue?}', 'WebEventsController@index')->name('webevents.index');	
	Route::get('webevents/view/{rec_id}', 'WebEventsController@view')->name('webevents.view');	
	Route::get('webevents/add', 'WebEventsController@add')->name('webevents.add');
	Route::post('webevents/add', 'WebEventsController@store')->name('webevents.store');
		
	Route::any('webevents/edit/{rec_id}', 'WebEventsController@edit')->name('webevents.edit');	
	Route::get('webevents/delete/{rec_id}', 'WebEventsController@delete');

/* routes for WebExcos Controller */
	Route::get('webexcos', 'WebExcosController@index')->name('webexcos.index');
	Route::get('webexcos/index/{filter?}/{filtervalue?}', 'WebExcosController@index')->name('webexcos.index');	
	Route::get('webexcos/view/{rec_id}', 'WebExcosController@view')->name('webexcos.view');	
	Route::get('webexcos/add', 'WebExcosController@add')->name('webexcos.add');
	Route::post('webexcos/add', 'WebExcosController@store')->name('webexcos.store');
		
	Route::any('webexcos/edit/{rec_id}', 'WebExcosController@edit')->name('webexcos.edit');	
	Route::get('webexcos/delete/{rec_id}', 'WebExcosController@delete');

/* routes for WebGalleries Controller */
	Route::get('webgalleries', 'WebGalleriesController@index')->name('webgalleries.index');
	Route::get('webgalleries/index/{filter?}/{filtervalue?}', 'WebGalleriesController@index')->name('webgalleries.index');	
	Route::get('webgalleries/view/{rec_id}', 'WebGalleriesController@view')->name('webgalleries.view');	
	Route::get('webgalleries/add', 'WebGalleriesController@add')->name('webgalleries.add');
	Route::post('webgalleries/add', 'WebGalleriesController@store')->name('webgalleries.store');
		
	Route::any('webgalleries/edit/{rec_id}', 'WebGalleriesController@edit')->name('webgalleries.edit');	
	Route::get('webgalleries/delete/{rec_id}', 'WebGalleriesController@delete');

/* routes for WebHeaders Controller */
	Route::get('webheaders', 'WebHeadersController@index')->name('webheaders.index');
	Route::get('webheaders/index/{filter?}/{filtervalue?}', 'WebHeadersController@index')->name('webheaders.index');	
	Route::get('webheaders/view/{rec_id}', 'WebHeadersController@view')->name('webheaders.view');	
	Route::get('webheaders/add', 'WebHeadersController@add')->name('webheaders.add');
	Route::post('webheaders/add', 'WebHeadersController@store')->name('webheaders.store');
		
	Route::any('webheaders/edit/{rec_id}', 'WebHeadersController@edit')->name('webheaders.edit');	
	Route::get('webheaders/delete/{rec_id}', 'WebHeadersController@delete');

/* routes for WebRegistrations Controller */
	Route::get('webregistrations', 'WebRegistrationsController@index')->name('webregistrations.index');
	Route::get('webregistrations/index/{filter?}/{filtervalue?}', 'WebRegistrationsController@index')->name('webregistrations.index');	
	Route::get('webregistrations/view/{rec_id}', 'WebRegistrationsController@view')->name('webregistrations.view');	
	Route::get('webregistrations/add', 'WebRegistrationsController@add')->name('webregistrations.add');
	Route::post('webregistrations/add', 'WebRegistrationsController@store')->name('webregistrations.store');
		
	Route::any('webregistrations/edit/{rec_id}', 'WebRegistrationsController@edit')->name('webregistrations.edit');	
	Route::get('webregistrations/delete/{rec_id}', 'WebRegistrationsController@delete');

/* routes for WebResources Controller */
	Route::get('webresources', 'WebResourcesController@index')->name('webresources.index');
	Route::get('webresources/index/{filter?}/{filtervalue?}', 'WebResourcesController@index')->name('webresources.index');	
	Route::get('webresources/view/{rec_id}', 'WebResourcesController@view')->name('webresources.view');	
	Route::get('webresources/add', 'WebResourcesController@add')->name('webresources.add');
	Route::post('webresources/add', 'WebResourcesController@store')->name('webresources.store');
		
	Route::any('webresources/edit/{rec_id}', 'WebResourcesController@edit')->name('webresources.edit');	
	Route::get('webresources/delete/{rec_id}', 'WebResourcesController@delete');

/* routes for WebSettings Controller */
	Route::get('websettings', 'WebSettingsController@index')->name('websettings.index');
	Route::get('websettings/index/{filter?}/{filtervalue?}', 'WebSettingsController@index')->name('websettings.index');	
	Route::get('websettings/view/{rec_id}', 'WebSettingsController@view')->name('websettings.view');	
	Route::get('websettings/add', 'WebSettingsController@add')->name('websettings.add');
	Route::post('websettings/add', 'WebSettingsController@store')->name('websettings.store');
		
	Route::any('websettings/edit/{rec_id}', 'WebSettingsController@edit')->name('websettings.edit');	
	Route::get('websettings/delete/{rec_id}', 'WebSettingsController@delete');

/* routes for WebSliders Controller */
	Route::get('websliders', 'WebSlidersController@index')->name('websliders.index');
	Route::get('websliders/index/{filter?}/{filtervalue?}', 'WebSlidersController@index')->name('websliders.index');	
	Route::get('websliders/view/{rec_id}', 'WebSlidersController@view')->name('websliders.view');	
	Route::get('websliders/add', 'WebSlidersController@add')->name('websliders.add');
	Route::post('websliders/add', 'WebSlidersController@store')->name('websliders.store');
		
	Route::any('websliders/edit/{rec_id}', 'WebSlidersController@edit')->name('websliders.edit');	
	Route::get('websliders/delete/{rec_id}', 'WebSlidersController@delete');

/* routes for WebTestimonials Controller */
	Route::get('webtestimonials', 'WebTestimonialsController@index')->name('webtestimonials.index');
	Route::get('webtestimonials/index/{filter?}/{filtervalue?}', 'WebTestimonialsController@index')->name('webtestimonials.index');	
	Route::get('webtestimonials/view/{rec_id}', 'WebTestimonialsController@view')->name('webtestimonials.view');	
	Route::get('webtestimonials/add', 'WebTestimonialsController@add')->name('webtestimonials.add');
	Route::post('webtestimonials/add', 'WebTestimonialsController@store')->name('webtestimonials.store');
		
	Route::any('webtestimonials/edit/{rec_id}', 'WebTestimonialsController@edit')->name('webtestimonials.edit');	
	Route::get('webtestimonials/delete/{rec_id}', 'WebTestimonialsController@delete');

/* routes for WebTopbars Controller */
	Route::get('webtopbars', 'WebTopbarsController@index')->name('webtopbars.index');
	Route::get('webtopbars/index/{filter?}/{filtervalue?}', 'WebTopbarsController@index')->name('webtopbars.index');	
	Route::get('webtopbars/view/{rec_id}', 'WebTopbarsController@view')->name('webtopbars.view');	
	Route::get('webtopbars/add', 'WebTopbarsController@add')->name('webtopbars.add');
	Route::post('webtopbars/add', 'WebTopbarsController@store')->name('webtopbars.store');
		
	Route::any('webtopbars/edit/{rec_id}', 'WebTopbarsController@edit')->name('webtopbars.edit');	
	Route::get('webtopbars/delete/{rec_id}', 'WebTopbarsController@delete');

/* routes for WebVissions Controller */
	Route::get('webvissions', 'WebVissionsController@index')->name('webvissions.index');
	Route::get('webvissions/index/{filter?}/{filtervalue?}', 'WebVissionsController@index')->name('webvissions.index');	
	Route::get('webvissions/view/{rec_id}', 'WebVissionsController@view')->name('webvissions.view');	
	Route::get('webvissions/add', 'WebVissionsController@add')->name('webvissions.add');
	Route::post('webvissions/add', 'WebVissionsController@store')->name('webvissions.store');
		
	Route::any('webvissions/edit/{rec_id}', 'WebVissionsController@edit')->name('webvissions.edit');	
	Route::get('webvissions/delete/{rec_id}', 'WebVissionsController@delete');
});

	
	Route::get('users/ban', 'usersController@ban')->name('users.ban')->middleware(['auth']);
	
Route::get('componentsdata/session_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->session_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/updated_by_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->updated_by_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/subject_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->subject_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/grade_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->grade_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/term_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->term_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/grades_name_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->grades_name_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/grades_remarks_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->grades_remarks_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->role_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/plans_updated_by_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->plans_updated_by_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/class_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->class_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/subjects_name_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->subjects_name_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/price_settings_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->price_settings_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_email_value_exist($request);
	}
);
	
Route::get('componentsdata/users_name_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_name_value_exist($request);
	}
);
	
Route::get('componentsdata/users_phone_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_phone_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/category_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->category_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/name_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->name_option_list($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');