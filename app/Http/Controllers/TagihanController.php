<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagihanController extends Controller
{
    //
    public function index(){
        // $tagihan = Tagihan::all();
        return view("tagihan.index");
    }
}
