<?php

namespace AwemaPL\Chromator\Sections\Creators\Http\Controllers;

use AwemaPL\Auth\Controllers\Traits\RedirectsTo;
use AwemaPL\Chromator\Sections\Creators\Http\Requests\StoreCreate;
use AwemaPL\Chromator\Sections\Creators\Repositories\Contracts\HistoryRepository;
use AwemaPL\Chromator\Sections\Creators\Resources\EloquentHistory;
use AwemaPL\Chromator\Sections\Creators\Services\ExtensionCreatorService;
use AwemaPL\Chromator\Sections\Creators\Services\ExtensionNameService;
use AwemaPL\Chromator\Sections\Installations\Http\Requests\StoreInstallation;
use AwemaPL\Permission\Repositories\Contracts\PermissionRepository;
use AwemaPL\Permission\Resources\EloquentPermission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreatorController extends Controller
{

    /**
     * Histories repository instance
     *
     * @var HistoryRepository
     */
    protected $histories;

    /** @var ExtensionCreatorService $extensionCreator  */
    protected $extensionCreator;

    /** @var ExtensionNameService $extensionName */
    protected $extensionName;

    public function __construct(HistoryRepository $histories, ExtensionCreatorService $extensionCreator, ExtensionNameService $extensionName)
    {
        $this->histories = $histories;
        $this->extensionCreator = $extensionCreator;
        $this->extensionName = $extensionName;
    }

    /**
     * Display create extension form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('chromator::sections.creators.index');
    }

    /**
     * Request scope
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function scope(Request $request)
    {
        return EloquentHistory::collection(
            $this->histories->scope($request)
                ->latest()->smartPaginate()
        );
    }

    /**
     * Download extension
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function download($filename)
    {
        $path = 'temp/chromator/' . $filename . '.zip';
        if (!Storage::exists($path)){
            abort(404);
        }
        session()->push('terminate-delete-files', $path);
        return Storage::download($path);
    }

    /**
     * Create extension
     *
     * @param StoreCreate $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(StoreCreate $request)
    {
        $withPackage= $request->with_package;
        $nameExtension = $this->extensionName->buildName($request->name_extension);
        $dirTempName = $this->extensionCreator->buildZipExtension($nameExtension, $withPackage);
        $this->histories->create(['name' => $nameExtension, 'with_package' =>$withPackage]);
        return response()->json([
            'redirectUrl' =>route('chromator.creator.download', ['filename' => $dirTempName]),
        ]);
    }
}
