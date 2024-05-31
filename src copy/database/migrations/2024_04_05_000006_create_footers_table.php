<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createsupir bussTable extends Migration
{
    public function up()
    {
        Schema::create('supir buss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('detail')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('phone')->nullable();
            $table->string('faximile')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
