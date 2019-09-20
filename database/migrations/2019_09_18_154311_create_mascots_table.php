<?php

use App\Mascot;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('exp');
            $table->unsignedInteger('level');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        $this->seed();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascots');
    }

    private function seed()
    {
        factory(Mascot::class)->create(['user_id' => 1, 'exp' => 0]);
    }
}
