<?php

namespace App\Controllers;

class ViewController extends BaseController
{
    public function showLoginPage()
    {
        return view('login_view');
    }

    public function showRegistrationPage()
    {
        return view('registration_view');
    }

    public function showSuccessPage(){
        return view('success_page');
    }

    public function showDashboardPage(){
        return view('dashboard_page');
    }

    public function print(){
        return view('print');
    }
}

