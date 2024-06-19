<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('comment_tk')->nullable();
            $table->string('comment_ru')->nullable();
            $table->string('comment_en')->nullable();
            $table->timestamp('departure_date')->nullable();
            $table->string('in_arhive')->default(false);
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->unsignedBigInteger('storage_id');
            $table->timestamps();

            $table->foreign('storage_id')->references('id')->on('storages')->onDelete('cascade');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('containers');
    }
}
