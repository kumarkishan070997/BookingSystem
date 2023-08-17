<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record_count = 10;
        while($record_count--){
            $obj = new Ticket;
            $obj->A = false;
            $obj->B = false;
            $obj->C = false;
            $obj->D = false;
            $obj->E = false;
            $obj->F = false;
            $obj->G = false;
            $obj->H = false;
            $obj->I = false;
            $obj->J = false;
            $obj->K = false;
            $obj->L = false;
            $obj->M = false;
            $obj->N = false;
            $obj->O = false;
            $obj->P = false;
            $obj->Q = false;
            $obj->R = false;
            $obj->S = false;
            $obj->T = false;
            $obj->save();
        }
    }
}
