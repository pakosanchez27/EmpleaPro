<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    public function index(){
        return view('candidato.home');
    }
}
