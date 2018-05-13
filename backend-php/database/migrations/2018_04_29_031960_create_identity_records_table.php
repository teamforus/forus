<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentityRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('identity_id')->unsigned();
            $table->integer('record_type_id')->unsigned();
            $table->integer('identity_record_category_id')->unsigned()->nullable();
            $table->string('value')->default('');
            $table->integer('order')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('identity_id'
            )->references('id')->on('identities')->onDelete('cascade');

            $table->foreign('record_type_id'
            )->references('id')->on('record_types')->onDelete('cascade');

            $table->foreign('identity_record_category_id'
            )->references('id')->on('identity_record_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity_records');
    }
}
