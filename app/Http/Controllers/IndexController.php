<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        return Inertia::render('HomePage', [
            'title' => 'Allbtc',
        ]);
    }

    public function complexity()
    {
        return Inertia::render('ComplexityPage', []);
    }
    public function help()
    {
        return Inertia::render('FaqPage', []);
    }

    public function about()
    {
        return Inertia::render('AboutPage', []);
    }

//    public function about()
//    {
//        return Inertia::render('der/AboutPage', [
//            'title' => 'about',
//        ]);
//    }
}
