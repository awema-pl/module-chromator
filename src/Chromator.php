<?php

namespace AwemaPL\Chromator;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Routing\Router;
use AwemaPL\Chromator\Contracts\Chromator as ChromatorContract;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class Chromator implements ChromatorContract
{
    /** @var Router $router */
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Routes
     */
    public function routes()
    {
        if ($this->isActiveRoutes()) {
            if ($this->isActiveInstallationRoutes()) {
                $this->installationRoutes();
            }
            if ($this->isActiveCreatorRoutes()) {
                $this->creatorRoutes();
            }
            if ($this->isActiveExampleRoutes()) {
                $this->exampleRoutes();
            }
            if ($this->isActiveInformationRoutes()) {
                $this->informationRoutes();
            }
        }
    }

    /**
     * Installation routes
     */
    protected function installationRoutes()
    {
        $prefix = config('chromator.routes.installation.prefix');
        $namePrefix = config('chromator.routes.installation.name_prefix');
        $this->router->prefix($prefix)->name($namePrefix)->group(function () {
            $this->router
                ->get('/', '\AwemaPL\Chromator\Sections\Installations\Http\Controllers\InstallationController@index')
                ->name('index');
            $this->router->post('/', '\AwemaPL\Chromator\Sections\Installations\Http\Controllers\InstallationController@store')
                ->name('store');
        });

    }

    /**
     * Creator routes
     */
    protected function creatorRoutes()
    {

        $prefix = config('chromator.routes.creator.prefix');
        $namePrefix = config('chromator.routes.creator.name_prefix');
        $middleware = config('chromator.routes.creator.middleware');
        $this->router->prefix($prefix)->name($namePrefix)->middleware($middleware)->group(function () {
            $this->router
                ->get('/', '\AwemaPL\Chromator\Sections\Creators\Http\Controllers\CreatorController@index')
                ->name('index');
            $this->router
                ->post('/', '\AwemaPL\Chromator\Sections\Creators\Http\Controllers\CreatorController@store')
                ->name('store');
            $this->router
                ->get('/histories', '\AwemaPL\Chromator\Sections\Creators\Http\Controllers\CreatorController@scope')
                ->name('scope');
            $this->router
                ->get('/download/{filename}', '\AwemaPL\Chromator\Sections\Creators\Http\Controllers\CreatorController@download')
                ->name('download');
        });
    }

    /**
     * Example routes
     */
    protected function exampleRoutes()
    {

        $prefix = config('chromator.routes.example.prefix');
        $namePrefix = config('chromator.routes.example.name_prefix');
        $middleware = config('chromator.routes.example.middleware');
        $this->router->prefix($prefix)->name($namePrefix)->middleware($middleware)->group(function () {
            $this->router
                ->get('/', '\AwemaPL\Chromator\Sections\Examples\Http\Controllers\ExampleController@index')
                ->name('index');
            $this->router
                ->get('/', '\AwemaPL\Chromator\Sections\Examples\Http\Controllers\ExampleController@index')
                ->name('index');
            $this->router
                ->get('/virtual-tour-from-beginning', '\AwemaPL\Chromator\Sections\Examples\Http\Controllers\ExampleController@virtualTourFromBeginning')
                ->name('virtual_tour_from_beginning');
        });
    }

    /**
     * Information routes
     */
    protected function informationRoutes()
    {
        $prefix = config('chromator.routes.information.prefix');
        $namePrefix = config('chromator.routes.information.name_prefix');
        $middleware = config('chromator.routes.information.middleware');
        $this->router->prefix($prefix)->name($namePrefix)->middleware($middleware)->group(function () {
            $this->router
                ->get('/informations', '\AwemaPL\Chromator\Sections\Informations\Http\Controllers\InformationController@scope')
                ->name('scope');
        });
    }


    /**
     * Can installation
     *
     * @return bool
     */
    public function canInstallation()
    {
        $canForPermission = $this->canInstallForPermission();
        return $this->isActiveRoutes()
            && $this->isActiveInstallationRoutes()
            && $canForPermission
            && !$this->isMigrated();
    }

    /**
     * Is migrated
     *
     * @return bool
     */
    public function isMigrated()
    {
        $tablesInDb = array_map('reset', \DB::select('SHOW TABLES'));
        $tables = array_values(config('chromator.database.tables'));
        foreach ($tables as $table) {
            if (!in_array($table, $tablesInDb)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Is active routes
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function isActiveRoutes()
    {
        return config('chromator.routes.active');
    }

    /**
     * Is active chromator routes
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function isActiveCreatorRoutes()
    {
        return config('chromator.routes.creator.active');
    }

    /**
     * Is active installation routes
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private function isActiveInstallationRoutes()
    {
        return config('chromator.routes.installation.active');
    }

    /**
     * Is active example routes
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private function isActiveExampleRoutes()
    {
        return config('chromator.routes.example.active');
    }


    /**
     * Is active information routes
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private function isActiveInformationRoutes()
    {
        return config('chromator.routes.information.active');
    }

    /**
     * Include lang JS
     */
    public function includeLangJs()
    {
        $lang = config('indigo-layout.frontend.lang', []);
        $lang = array_merge_recursive($lang, app(\Illuminate\Contracts\Translation\Translator::class)->get('chromator::js'));
        app('config')->set('indigo-layout.frontend.lang', $lang);
    }

    /**
     * Can install for permission
     *
     * @return bool
     */
    private function canInstallForPermission()
    {
        $userClass = config('auth.providers.users.model');
        if (!method_exists($userClass, 'hasRole')) {
            return true;
        }
        if ($user = request()->user() ?? null) {
            return $user->can(config('chromator.installation.auto_redirect.permission'));
        }
        return false;
    }

    /**
     * Menu merge in navigation
     */
    public function menuMerge()
    {
        if ($this->canMergeMenu()) {
            $chromatorNav = config('chromator-menu.navs', []);
            $navTemp = config('temp_navigation.navs', []);
            $nav = array_merge_recursive($navTemp, $chromatorNav);
            config(['temp_navigation.navs' => $nav]);
        }
    }

    /**
     * Can merge menu
     *
     * @return boolean
     */
    private function canMergeMenu()
    {
        return !!config('chromator-menu.merge_to_navigation') && self::isMigrated();
    }

    /**
     * Execute extension migrations
     */
    public function migrate()
    {
        Artisan::call('migrate', ['--force' => true, '--path'=>'vendor/awema-pl/module-chromator/database/migrations']);
    }


    /**
     * Install package
     */
    public function install()
    {
        $this->migrate();
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
    }

    /**
     * Add permissions for module permission
     */
    public function mergePermissions()
    {
        if ($this->canMergePermissions()){
            $chromatorPermissions = config('chromator.permissions');
            $tempPermissions = config('temp_permission.permissions', []);
            $permissions = array_merge_recursive($tempPermissions, $chromatorPermissions);
            config(['temp_permission.permissions' => $permissions]);
        }
    }

    /**
     * Can merge permissions
     *
     * @return boolean
     */
    private function canMergePermissions()
    {
        return !!config('chromator.merge_permissions');
    }

}
