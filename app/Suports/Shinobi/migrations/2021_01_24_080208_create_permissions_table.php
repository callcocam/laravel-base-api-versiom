<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $name = config('shinobi.tables.permissions');

        Schema::create($name, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('groups', 100);
            $table->text('description')->nullable();
            $table->status();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        $name = config('shinobi.tables.permissions');

        Schema::drop($name);
    }
}
