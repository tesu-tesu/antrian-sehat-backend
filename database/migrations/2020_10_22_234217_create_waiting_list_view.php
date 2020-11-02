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
                    wl.barcode, wl.status, wl.schedule_id, day, p.id polyclinic_id, pm.name polyclinic,
                    h.id health_agency_id ,h.name health_agency,
                    (wl.order_number - w.order_number) distance_number, w.order_number current_number,
                        (SELECT MAX(wx.order_number)
                        FROM waiting_lists AS wx
                        WHERE wx.schedule_id = w.schedule_id AND wx.registered_date = w.registered_date
                        GROUP BY wx.schedule_id AND wx.registered_date) latest_number
                    FROM waiting_lists wl
                        INNER JOIN waiting_lists w
                        ON wl.registered_date = w.registered_date AND wl.schedule_id = w.schedule_id
                        INNER JOIN schedules s
                        ON w.schedule_id = s.id
                        INNER JOIN polyclinics p
                        ON s.polyclinic_id = p.id
                        INNER JOIN poly_masters pm
                        ON p.poly_master_id = pm.id
                        INNER JOIN health_agencies h
                        ON p.health_agency_id = h.id
                    WHERE (w.status = 'Sedang Diperiksa' OR w.order_number = (SELECT MIN(wx.order_number)
                            FROM waiting_lists AS wx
                            WHERE wx.schedule_id = w.schedule_id AND wx.registered_date = w.registered_date
                            GROUP BY wx.schedule_id AND wx.registered_date))
                    ORDER BY registered_date, distance_number");
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
