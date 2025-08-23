<?php

namespace App\Http\Controllers;



class HomeController extends Controller
{
    public function index(){
        return view("home");
    }
    public function contact(){
        return view("contact");
    }
    public function propertie(){
        return view("propertie");
    }
    public function details(){
        return view("propertiesDetails");
    }
    public function Rentdetails(){
        return view("RentDetails");
    }
}
