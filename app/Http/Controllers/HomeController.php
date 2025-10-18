<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    // public function index(){
    //     return view("home");
    // }
    public function contact(){
        return view("contact");
    }
    public function propertie(){
        return view("properties");
    }
    public function details(){
        return view("propertiesDetails");
    }
    public function Rentdetails(){
        return view("RentDetails");
    }
    public function Abonnement(){
        return view("abonnement");
    }
}
