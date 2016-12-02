<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_requests', function (Blueprint $table){
            $table->increments('id');
            $table->string('type')->default('app');
            $table->string('url')->nullable();
            $table->string('request_method')->nullable();
            $table->text('request_headers')->nullable();
            $table->text('request_body')->nullable();
            $table->text('response_headers')->nullable();
            $table->text('response_body')->nullable();
            $table->integer('status_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('app_requests');
    }
}
