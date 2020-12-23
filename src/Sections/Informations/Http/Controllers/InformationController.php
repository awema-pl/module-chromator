<?php

namespace AwemaPL\Chromator\Sections\Informations\Http\Controllers;

use AwemaPL\Auth\Controllers\Traits\RedirectsTo;
use AwemaPL\Chromator\Sections\Creators\Http\Requests\StoreCreate;
use AwemaPL\Chromator\Sections\Creators\Repositories\Contracts\HistoryRepository;
use AwemaPL\Chromator\Sections\Creators\Resources\EloquentHistory;
use AwemaPL\Chromator\Sections\Creators\Services\ExtensionCreatorService;
use AwemaPL\Chromator\Sections\Creators\Services\ExtensionNameService;
use AwemaPL\Chromator\Sections\Installations\Http\Requests\StoreInstallation;
use AwemaPL\Chromator\Sections\Users\Repositories\Contracts\UserRepository;
use AwemaPL\Chromator\Sections\Informations\Resources\EloquentInformation;
use AwemaPL\Permission\Repositories\Contracts\PermissionRepository;
use AwemaPL\Permission\Resources\EloquentPermission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformationController extends Controller
{
    /**
     * Information
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function scope(Request $request)
    {
        return response()->json(new EloquentInformation($request),200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
