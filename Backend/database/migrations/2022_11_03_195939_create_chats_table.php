<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
   
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            
            $table->integer('user_1')->nullable();
            $table->integer('user_2')->nullable();
            $table->boolean('active')->nullable()->default(true);

            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
