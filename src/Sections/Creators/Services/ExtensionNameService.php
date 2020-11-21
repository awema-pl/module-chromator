<?php

namespace AwemaPL\Chromator\Sections\Creators\Services;
use Illuminate\Support\Str;

class ExtensionNameService
{

    /**
     * Build name
     *
     * @param $blankNameExtension
     * @return string
     */
    public function buildName($blankNameExtension)
    {
        return Str::ucfirst(mb_strtolower(preg_replace("/[^a-zA-Z]+/", "", $blankNameExtension)));
    }
}
