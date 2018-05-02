<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentityRecordCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_record_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('identity_id')->unsigned();
            $table->string('name', 20);
            $table->integer('order')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('identity_id'
            )->references('id')->on('identities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity_record_categories');
    }
}
