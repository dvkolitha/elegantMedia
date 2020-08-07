<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_number')->unique();
            $table->string('name');
            $table->text('problem');
            $table->text('reply')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->boolean('is_open')->default(0);
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
        Schema::dropIfExists('guest_tickets');
    }
}
