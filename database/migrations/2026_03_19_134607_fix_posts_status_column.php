<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {

        if (DB::getDriverName() === 'pgsql') {
            DB::statement('TRUNCATE TABLE posts RESTART IDENTITY CASCADE');
            DB::statement('ALTER TABLE posts ALTER COLUMN status TYPE smallint USING status::smallint');
        } else {
            DB::statement('TRUNCATE TABLE posts');
            DB::statement('ALTER TABLE posts MODIFY status SMALLINT DEFAULT 1');
        }
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE posts MODIFY status BOOLEAN DEFAULT 1');
    }
};
