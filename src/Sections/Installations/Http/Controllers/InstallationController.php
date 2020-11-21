<?php

namespace AwemaPL\Chromator\Sections\Installations\Http\Controllers;

use AwemaPL\Auth\Controllers\Traits\RedirectsTo;
use AwemaPL\Chromator\Facades\Chromator;
use AwemaPL\Chromator\Sections\Installations\Http\Requests\StoreInstallation;
use Illuminate\Routing\Controller;

class InstallationController extends Controller
{

    use RedirectsTo;

    /**
     * Where to redirect after installation.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Display installation form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('chromator::sections.installations.index');
    }

    /**
     * Store setting installation.
     *
     * @param  StoreInstallation  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreInstallation $request)
    {
        Chromator::install();
        return $this->ajaxRedirectTo($request);
    }
}
