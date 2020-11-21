
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChromatorHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create(config('chromator.database.tables.chromator_histories'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop(config('chromator.database.tables.chromator_histories'));
    }
}
