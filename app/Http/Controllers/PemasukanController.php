<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    //
    public function index(){
        return view("pemasukan.index");
    }
    public function create(Request $request){
        return view("pemasukan.create");
    }

    public function edit(Request $request){
        return view("pemasukan.edit");
    }
}
