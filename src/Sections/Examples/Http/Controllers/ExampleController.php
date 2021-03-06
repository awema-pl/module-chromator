<?php

namespace AwemaPL\Chromator\Sections\Examples\Http\Controllers;

use AwemaPL\Auth\Controllers\Traits\RedirectsTo;
use AwemaPL\Chromator\Sections\Installations\Http\Requests\StoreInstallation;
use AwemaPL\VirtualTour\Tour;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ExampleController extends Controller
{
    /**
     * Display installation form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('chromator::sections.examples.index');
    }

    /**
     * Virtual tour from beginning
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function virtualTourFromBeginning()
    {
        Tour::setFromBeginning();
        return back();
    }
}
