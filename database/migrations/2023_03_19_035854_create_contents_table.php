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
            $table->string('slug');
            $table->string('image');
            $table->string('source');
            $table->string('description');
            $table->text('body');
            $table->bigInteger('author');
            $table->bigInteger('parent_id');
            $table->bigInteger('viewed');
            $table->boolean('is_shared_to_live_tv')->default(false);
            $table->string('attr_1');
            $table->bigInteger('active');
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
