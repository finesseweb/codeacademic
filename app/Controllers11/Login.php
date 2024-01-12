<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
		  echo view('loginheader');
         echo view('login/index');
		   echo view('footer');
    }
	
	public function login(){
		
		echo 'hii';
		
		
	}
	
	
	
	
	
	
	
	
}
