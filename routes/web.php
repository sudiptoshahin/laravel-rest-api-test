<?php

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

//  using the psr-7 requests for ServerRequestInterface
use Psr\Http\Message\ServerRequestInterface;

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

Route::get('/', function (ServerRequestInterface $request) {
    
    print(implode($request->getServerParams()));
    echo '<br><br>';    
    echo implode($request->getCookieParams());
    echo '<br><br>';   
    echo implode($request->getAttributes());
    // foreach($server_params as $param) {
    //     echo $param.'<br>';
    // }
});

Route::get('/time', function() {
    return config('app.timezone', 'America/Chicago');
});

Route::get('/maintenance', function() {
    return "<h1>Site is under maintenance</h1>";
});

Route::get('/db-test', function() {
    $result = DB::select("SELECT * FROM customers WHERE id=:id", ["id"=> 1]);

    //  querying the database
    // $users = DB::select('SELECT * FROM customers');
    /**
    $users = DB::table('customers')->get();

    foreach($users as $user) {
        echo $user->name.'<br>';
    }
    */

    //  collecting a single row
    // $user = DB::table('customers')->where('name', 'Libbie Schinner')->first();
    
    //  collecting a single value
    // $userEmail = DB::table('customers')->where('name', 'Libbie Schinner')->value('email');
    
    //  get a single value from all users
    // $allUserEmail = DB::table('customers')->pluck('email');
    // foreach($allUserEmail as $email) {
    //     echo $email.'<br>';
    // }

    //  when we have so many datas and we want to show a few
    // DB::table('customers')->orderBy('id')->chunk(100, function($users){
    //     foreach($users as $user) {
    //         echo $user->name.'<br>';
    //     }
    // });

    // DB::table('customers')->orderBy('id')->lazy()->each(function ($user) {
    //     echo $user->name.'<br>';
    // });

    //  aggregating method
    // $numberOfCustomers = DB::table('customers')->count();
    // echo '<br>'.$numberOfCustomers;

    // $maximumAmount = DB::table('invoices')->max('amount');
    // echo'<br>'.$maximumAmount;

    //  some value is exists or not in db
    // if(DB::table('customers')->where('name', 'Kari Collins')->exists()) {
    //     echo '<h2>He exists here.</h2>';
    // }

    //  distincts values
    // $invoices = DB::table('invoices')->distinct()->get();

    //  joins-inner
    // $amounts = DB::table('customers')
    //             ->join('invoices', 'customers.id', '=', 'invoices.customer_id')
    //             ->select('customers.name', 'customers.city', 'invoices.amount')
    //             ->get();
    // foreach($amounts as $amount) {
    //     echo $amount.'';
    // }

    // paginator
    // $customers = Customer::paginate(10)->withQueryString();

    //  fragment pagination
    $customers = Customer::paginate(10)->fragment('customers');
    // echo $customers->links();

    // if(Schema::hasTable('customers')) {
    //     return '<h3>We have customers</h3>';
    // }
    // if(Schema::hasColumn('customers', 'city')) {
    //     return '<h3>We have customers</h3>';
    // }


    /** ELOQUENT ORM */
    // foreach(Customer::all() as $customer) {
    //     echo '<br>'.$customer;
    // }

    // $invoices = Invoice::where('customer_id', 2)->get();
    // $invoices = $invoices->fresh();
    // foreach($invoices as $invoice) {
    //     echo $invoice->billed_date.'<br>';
    // }

    //  USING CHUNKS
    // The first argument passed to the chunk method is the number of records you wish to receive per "chunk". 
    //  the chunk method will provide significantly reduced memory usage when working with a large number of models
    // Customer::chunk(1, function ($customers) {
    //     foreach($customers as $customer) {
    //         echo '<br>'.$customer->name;
    //     }
    // });

    //  CURSOR
    // Although the cursor method uses far less memory than a regular query (
    $customers = Customer::cursor()->filter(function ($customer) {
        return $customer->id > 20;
    });

    $count = $customers->count();

    foreach($customers as $customer) {
        echo $customer->name.'<br>';
    }
    echo $count;

    return 'Hello';
});
