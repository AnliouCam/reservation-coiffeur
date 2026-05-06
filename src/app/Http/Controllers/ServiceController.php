<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('home', compact('services'));
    }

    public function choisir()
    {
        $services = Service::all();
        return view('reserver.choisir', compact('services'));
    }
}
