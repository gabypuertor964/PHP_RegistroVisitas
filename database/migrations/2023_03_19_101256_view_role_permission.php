<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement("
            CREATE VIEW `view_role_permission` AS
            SELECT 
                roles.id AS 'role_id',
                permissions.name AS 'permission_name'
                
            FROM roles INNER JOIN role_has_permissions
            on roles.id=role_has_permissions.role_id

            INNER JOIN permissions
            ON permissions.id=role_has_permissions.permission_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            DROP VIEW `view_role_permission`;
        ");
    }
};
