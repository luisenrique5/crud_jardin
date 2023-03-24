<?php

use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->Integer('idDocumentsTypes')->unsigned();

            $table->Foreign('idDocumentsTypes', 'documentTypeForeing')->references('id')->on('DocumentsTypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('documentTypeForeing');
            $table->dropColumn('idDocumentsTypes');
        });
    }
}
