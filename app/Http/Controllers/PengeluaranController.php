<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    //
    public function index(){
        return view("pengeluaran.index");

    }
    public function create(){
        return view("pengeluaran.create");
    }

    public function edit(Request $request){
        return view("pengeluaran.index");
    }

}
