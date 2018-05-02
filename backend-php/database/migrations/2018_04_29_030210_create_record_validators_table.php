<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordValidatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_validators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->timestamps();
        });

        Schema::create('record_validator_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('record_validator_id')->unsigned();
            $table->string('locale', 3);
            $table->string('name', 20);

            $table->unique(['record_validator_id', 'locale']);
            $table->foreign('record_validator_id'
            )->references('id')->on('record_validators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_validator_translations');
        Schema::dropIfExists('record_validators');
    }
}
