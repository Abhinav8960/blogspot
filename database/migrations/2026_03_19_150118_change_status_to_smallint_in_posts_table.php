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
            DB::statement('ALTER TABLE posts ALTER COLUMN status DROP DEFAULT');

            DB::statement('ALTER TABLE posts ALTER COLUMN status TYPE smallint USING status::smallint');

            DB::statement('ALTER TABLE posts ALTER COLUMN status SET DEFAULT 1');
        } else {
            DB::statement('ALTER TABLE posts MODIFY status SMALLINT DEFAULT 1');
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE posts ALTER COLUMN status TYPE boolean USING status::boolean');
        } else {
            DB::statement('ALTER TABLE posts MODIFY status BOOLEAN DEFAULT 1');
        }
    }
};
