
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
            $table->boolean('with_package');
            $table->string('name');
            $table->timestamps();
        });
        
        Schema::table(config('chromator.database.tables.chromator_histories'), function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->constrained(config('chromator.database.tables.users'))
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table(config('chromator.database.tables.chromator_histories'), function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        
        Schema::drop(config('chromator.database.tables.chromator_histories'));
    }
}
