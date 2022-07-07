<?php

namespace App\Http\Controllers\FrontWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontWebController extends Controller
{
    
    public function index()
    {
        return view('front_web.index');
    }

    public function activation()
    {
        return view('front_web.activation');
    }

    public function claim()
    {
        return view('front_web.claim');
    }

    public function terms()
    {
        return view('front_web.terms');
    }

    public function privacy()
    {
        return view('front_web.privacy');
    }
    
    public function ServiceCenter()
    {
        return view('front_web.service_center');
    }

    public function privacyTradeIn()
    {
        return view('front_web.privacy_tradein');
    }
}
