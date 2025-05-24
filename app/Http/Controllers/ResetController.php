<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetController extends Controller
{
    //
    public function reset()
    {
        // Disable foreign key checks (MySQL specific)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables (hapus semua data)
        DB::table('monitorings')->truncate();
        DB::table('links')->truncate();
        DB::table('platforms')->truncate();

        // Enable foreign key checks again
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'Tabel berhasil dikosongkan.');
    }

}
