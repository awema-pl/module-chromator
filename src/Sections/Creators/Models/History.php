<?php

namespace AwemaPL\Chromator\Sections\Creators\Models;

use Illuminate\Database\Eloquent\Model;
use AwemaPL\Chromator\Sections\Creators\Models\Contracts\History as HistoryContract;

class History extends Model implements HistoryContract
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id','with_package'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'with_package' => 'boolean',
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('chromator.database.tables.chromator_histories');
    }


}
