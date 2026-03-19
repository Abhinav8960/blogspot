<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {

            // Step 1: default hatao
            DB::statement('ALTER TABLE posts ALTER COLUMN status DROP DEFAULT');

            // Step 2: boolean → smallint (manual mapping)
            DB::statement("
                ALTER TABLE posts 
                ALTER COLUMN status TYPE smallint 
                USING (CASE WHEN status = true THEN 1 ELSE 0 END)
            ");

            // Step 3: default set karo
            DB::statement('ALTER TABLE posts ALTER COLUMN status SET DEFAULT 1');
        } else {
            DB::statement('ALTER TABLE posts MODIFY status SMALLINT DEFAULT 1');
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement("
                ALTER TABLE posts 
                ALTER COLUMN status TYPE boolean 
                USING (CASE WHEN status = 1 THEN true ELSE false END)
            ");
        } else {
            DB::statement('ALTER TABLE posts MODIFY status BOOLEAN DEFAULT 1');
        }
    }
};
