<?php

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



/*route for test purpose*/
Route::get('/createTestUser',function () {
  $user = new App\User;
  $user->name = 'kolitha';
  $user->email = 'dvkolitha@gmail.com';
  $user->is_support_agent = 1 ;
  $user->password = bcrypt('kolitha');
  $user->save();      
 echo 'User was created';
}); 

/*
Guest User Required Routes
*/
Route::get('/','Guest\GuestTicketController@welcome');
Route::resource('/tickets','Guest\GuestTicketController', ['except' => ['edit', 'update', 'destroy']]);


/*
Support Agent Required Routes
*/

Route::get('/dashboard','SupportAgent\SupportAgentController@index');
Route::get('/dashboard/ticket/list','SupportAgent\SupportAgentController@ticketList');
Route::post('/ticket/reply','SupportAgent\SupportAgentController@ticketReply');
Route::get('/ticket/view/{id}','SupportAgent\SupportAgentController@viewTicket');
Auth::routes();





