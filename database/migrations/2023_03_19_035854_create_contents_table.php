<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('source')->nullable();
            $table->string('description')->nullable();
            $table->text('body')->nullable();
            $table->bigInteger('author')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('viewed')->nullable();
            $table->boolean('is_shared_to_live')->nullable();
            $table->string('attr_1')->nullable();
            $table->bigInteger('active')->nullable();
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
        Schema::dropIfExists('contents');
    }
};
