<?php

namespace AwemaPL\Chromator\Sections\Creators\Services;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Finder\Finder;
use ZanySoft\Zip\Zip;

class ExtensionCreatorService
{

    /** @var Finder $finder */
    protected $finder;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * Build Zip extension
     *
     * @param string $nameExtension
     * @param bool $withPackage
     * @return string
     * @throws Exception
     */
    public function buildZipExtension(string $nameExtension, bool $withPackage)
    {
        $extensionSourceFiles = $this->extensionSourceFiles($withPackage);
        $dirTempName = $this->buildFilename($nameExtension);
        $this->copyDirectories($nameExtension, $extensionSourceFiles, $dirTempName);
        $this->copyFiles($nameExtension, $extensionSourceFiles, $dirTempName);
        $this->buildZip($dirTempName);
        $this->sendToStorage($dirTempName);
        $this->deleteDirTempByName($dirTempName);
        return $dirTempName;
    }

    /**
     * Dir extension source
     *
     * @param bool $withPackage
     * @return false|string
     */
    private function dirExtensionSource(bool $withPackage)
    {
        if ($withPackage){
            return realpath(__DIR__ . '/../../../../');
        } else {
            return realpath(__DIR__ . '/../../../../extension');
        }
    }

    /**
     * Extension source files
     *
     * @param bool $withPackage
     * @return Finder
     */
    private function extensionSourceFiles(bool $withPackage)
    {
        $dirExtensionSource = $this->dirExtensionSource($withPackage);
        return $this->finder
            ->ignoreDotFiles(false)
            ->ignoreVCSIgnored(true)
            ->in($dirExtensionSource);
    }

    /**
     * Build filename
     *
     * @param string $nameExtension
     * @return string
     */
    private function buildFilename(string $nameExtension)
    {
        return $nameExtension . '-' . str_replace('-', '',mb_strtolower(Uuid::uuid4()));
    }

    /**
     * Copy directory
     *
     * @param $nameExtension
     * @param string $dirTempName
     * @param string $relativePath
     */
    private function copyDirectory($nameExtension, string $dirTempName, string $relativePath)
    {
        $dirTempPath = $this->dirTempPath($dirTempName);
        $relativePath = $this->replaceNameExtensionWords($nameExtension, $relativePath);
        $toPath = $dirTempPath . '/' . $relativePath;
        if (!File::exists($toPath)) {
            mkdir($toPath, 0777, true);
        }
    }

    /**
     * Copy file
     *
     * @param $nameExtension
     * @param string $realPath
     * @param string $dirTempName
     * @param string $relativePath
     */
    private function copyFile($nameExtension, string $realPath, string $dirTempName, string $relativePath)
    {
        $dirTempPath = $this->dirTempPath($dirTempName);
        $relativePath = $this->replaceNameExtensionWords($nameExtension, $relativePath);
        $content = File::get($realPath);
        $content = $this->replaceNameExtensionWords($nameExtension, $content);
        $toPath = $dirTempPath . '/' . $relativePath;
        File::put($toPath, $content);
    }

    /**
     * Copy directories
     * @param $nameExtension
     * @param $extensionSourceFiles
     * @param $dirTempName
     */
    private function copyDirectories($nameExtension, $extensionSourceFiles, $dirTempName)
    {
        foreach ($extensionSourceFiles as $file) {
            $relativePath = $file->getRelativePathname();
            $realPath = $file->getRealPath();
            if (File::isDirectory($realPath)) {
                $this->copyDirectory($nameExtension, $dirTempName, $relativePath);
            }
        }
    }

    /**
     * Copy files
     *
     * @param $nameExtension
     * @param $extensionSourceFiles
     * @param $dirTempName
     */
    private function copyFiles($nameExtension, $extensionSourceFiles, $dirTempName)
    {
        foreach ($extensionSourceFiles as $file) {
            $relativePath = $file->getRelativePathname();
            $realPath = $file->getRealPath();
            if (File::isFile($realPath)) {
                $this->copyFile($nameExtension, $realPath, $dirTempName, $relativePath);
            }
        }
    }

    /**
     * Replace name extension words
     *
     * @param $nameExtension
     * @param $content
     * @return string|string[]
     */
    private function replaceNameExtensionWords($nameExtension, $content)
    {
        return str_replace([
            'chromator',
            'Chromator',
            'CHROMATOR',
        ], [
            mb_strtolower($nameExtension),
            Str::ucfirst(mb_strtolower($nameExtension)),
            mb_strtoupper($nameExtension),
        ], $content);
    }

    /**
     * Build ZIP path
     *
     * @param $dirTempName
     * @throws Exception
     */
    private function buildZip($dirTempName)
    {
        $dirTempPath = $this->dirTempPath($dirTempName);
        $zipPath = $dirTempPath . '.zip';
        $zip = Zip::create($zipPath);
        $zip->add($dirTempPath);
        $zip->close();
    }

    /**
     * Directory temporary path
     *
     * @param string $dirTempName
     * @return string
     */
    private function dirTempPath(string $dirTempName)
    {
        return storage_path('app/temp/chromator/' . $dirTempName);
    }

    /**
     * Delete directory temporary by name
     *
     * @param string $dirTempName
     */
    private function deleteDirTempByName(string $dirTempName)
    {
        $dirTempPath = $this->dirTempPath($dirTempName);
        File::deleteDirectory($dirTempPath);
    }

    /**
     * Send to storage
     *
     * @param string $dirTempName
     */
    private function sendToStorage(string $dirTempName)
    {
        $zipTempPath = $this->dirTempPath($dirTempName) . '.zip';
        $zipPath = 'temp/chromator/' . $dirTempName  . '.zip';
        if (!Storage::exists($zipPath)){
            $content = File::get($zipTempPath);
            Storage::put($zipPath, $content);
        }
    }
}
