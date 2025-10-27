<?php namespace App\Controllers;

class Auth extends BaseController {
  public function loginForm() {
    return view('auth/login');
  }
}