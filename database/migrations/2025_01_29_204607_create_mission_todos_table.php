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
        Schema::create('mission_todos', function (Blueprint $table)
        {
                $table->increments('id');
                $table->unsignedInteger('list_id')->nullable();
                $table->unsignedBigInteger('user_id');
                $table->string('task');
                $table->boolean('checked')->default(false);
                $table->integer('sort_order');
                $table->date('deadline')->nullable();
                $table->timestamps();

                $table->foreign('list_id')
                        ->references('id')
                        ->on('lists')
                        ->onDelete('cascade');

                $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('mission_todos', function (Blueprint $table)
        {
            $table->dropForeign(['list_id']);  // list_id の外部キー制約を削除
            $table->dropForeign(['user_id']); 
        });

        Schema::dropIfExists('mission_todos');

    }
};
