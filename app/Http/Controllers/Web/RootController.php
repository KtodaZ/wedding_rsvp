<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class RootController extends Controller {
    public function index() {
      return view('index');
    }
}