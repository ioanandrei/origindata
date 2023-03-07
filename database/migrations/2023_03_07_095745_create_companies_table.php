<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('companies', function(Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('legal_identifier')->unique();
            $table->timestamps();
        });

        Schema::table('employees', function(Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('employees', function(Blueprint $table) {
            $table->dropForeign('employee_company_id');
            $table->dropColumn('company_id');
        });

        Schema::dropIfExists('companies');
    }
};
