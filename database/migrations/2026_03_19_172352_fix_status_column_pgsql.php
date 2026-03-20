<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {

            DB::statement('ALTER TABLE posts ALTER COLUMN status DROP DEFAULT');

            DB::statement("
                ALTER TABLE posts 
                ALTER COLUMN status TYPE smallint 
                USING (CASE WHEN status IS TRUE THEN 1 ELSE 0 END)
            ");

            DB::statement('ALTER TABLE posts ALTER COLUMN status SET DEFAULT 1');
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
        }
    }
};
