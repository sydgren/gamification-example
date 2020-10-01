<?php

use App\Models\Objective;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuestObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_quest_objectives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_quest_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Objective::class)->constrained()->onDelete('cascade');
            $table->integer('progress')->default(0);
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
        Schema::dropIfExists('user_quest_objectives');
    }
}
