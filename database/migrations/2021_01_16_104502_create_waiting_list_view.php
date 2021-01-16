<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaitingListView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE VIEW waiting_list_view AS (
                SELECT wl.id, wl.user_id, wl.residence_number, wl.registered_date, wl.barcode, 
                wl.status, wl.schedule_id, day, p.id polyclinic_id, pm.name polyclinic, h.id health_agency_id,
                h.name health_agency, wl.order_number, 
                    (SELECT COALESCE(MAX(wx.order_number), 0)
                    FROM waiting_lists AS wx
                    WHERE wx.schedule_id = wl.schedule_id AND wx.registered_date = wl.registered_date
                    GROUP BY wx.schedule_id AND wx.registered_date) latest_number,
                    COALESCE(
                        (SELECT MIN(x.order_number) FROM waiting_lists as x 
                        WHERE x.schedule_id = wl.schedule_id AND x.registered_date = wl.registered_date 
                        GROUP BY x.status HAVING x.status = 'Belum Diperiksa'), 0) as current_number,
                (wl.order_number - COALESCE(
                        (SELECT MIN(x.order_number) FROM waiting_lists as x 
                        WHERE x.schedule_id = wl.schedule_id AND x.registered_date = wl.registered_date 
                        GROUP BY x.status HAVING x.status = 'Belum Diperiksa'), 0)) distance_number
                FROM waiting_lists wl
                    INNER JOIN schedules s
                        ON wl.schedule_id = s.id
                    INNER JOIN polyclinics p
                        ON s.polyclinic_id = p.id
                    INNER JOIN poly_masters pm
                        ON p.poly_master_id = pm.id
                    INNER JOIN health_agencies h
                        ON p.health_agency_id = h.id
                ORDER BY wl.registered_date)"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS waiting_list_view");
    }
}
