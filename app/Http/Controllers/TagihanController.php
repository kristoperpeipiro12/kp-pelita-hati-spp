<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sail\Console\PublishCommand;

class TagihanController extends Controller
{
    //
    public function index(){
        // $tagihan = Tagihan::all();
        return view("tagihan.index");
    }
    Public function create(){
        return view("tagihan.create");
    }

    
}