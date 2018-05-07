<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentityRecordValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_record_validations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('record_validator_id')->unsigned();
            $table->integer('identity_record_id')->unsigned();
            $table->string('state', 20);
            $table->timestamps();

            $table->foreign('record_validator_id'
            )->references('id')->on('record_validators')->onDelete('cascade');

            $table->foreign('identity_record_id'
            )->references('id')->on('identity_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity_record_validations');
    }
}
