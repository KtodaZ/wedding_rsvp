<?php

Route::any('simple_email', '\App\Http\Controllers\Rpc\UpdateEmailController@sendEventContactsEmail')->middleware('auth');