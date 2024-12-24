<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTraineePackagePlanView extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW trainee_package_plan_view AS
            SELECT
                t.id AS trainee_id,
                t.user_name,
                t.first_name,
                t.last_name,
                t.phone,
                t.email,
                t.medical_history,
                t.goal,
                t.gender,
                t.height,
                t.weight,
                t.created_at AS registration_date,
                p.name AS package_name,
                pl.plan_name,
                p.coach_id
            FROM trainees t
            LEFT JOIN packages p ON t.package_id = p.id
            LEFT JOIN plans pl ON t.id = pl.trainee_id
        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS trainee_package_plan_view");
    }
}

