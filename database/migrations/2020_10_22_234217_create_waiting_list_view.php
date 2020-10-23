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
        DB::statement("CREATE VIEW waiting_list_view AS
                        SELECT wl.user_id, wl.residence_number, wl.registered_date, wl.order_number, 
                        wl.barcode, wl.status, day, pm.name polyclinic, h.name health_agency, 
                        (wl.order_number - w.order_number) distance_number, w.order_number current_number, 
                            (SELECT MAX(wx.order_number)
                            FROM waiting_lists AS wx
                            WHERE wx.schedule_id = w.schedule_id AND wx.registered_date = w.registered_date
                            GROUP BY wx.schedule_id AND wx.registered_date) latest_number
                        FROM waiting_lists AS wl, waiting_lists AS w, schedules AS s, 
                        polyclinics AS p, poly_masters AS pm, health_agencies AS h
                        WHERE wl.registered_date = w.registered_date
                        AND wl.schedule_id = w.schedule_id
                        AND w.status = 'Sedang Diperiksa'
                        AND wl.schedule_id = s.id)");
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
