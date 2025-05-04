<?php

namespace App\Http\Controllers;


use App\Models\Monitoring;
use App\Models\Link;
use App\Models\User;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestingController extends Controller
{
    //


    public function index()
{
    $links = Link::all(); // Semua link
    $platforms = Platform::all(); // Semua platform
    $userId = auth()->id();

    // Ambil semua monitoring user yang sedang login
    $monitorings = Monitoring::where('user_id', $userId)->get();

    // Buat mapping content => monitoring
    $monitoringMap = $monitorings->keyBy('content');

    foreach ($platforms as $platform) {
        echo "<h3>Platform: {$platform->name}</h3>";

        foreach ($links as $link) {
            $monitorings_by_platform = Monitoring::where('platform_id', $platform->id)
            ->where("user_id", $userId)
            ->where("content", $link->link)
            ->first();

            // echo "Link: {$link->link} | Context: {$link->context} => ";

            if ($monitorings_by_platform) {
                echo $monitorings_by_platform->id;
                echo "<br>";
            } else {
                echo "No monitoring data found";
                echo "<br>";

            }
            // Cek apakah link ini sudah dimonitor oleh user
            // if ($monitoringMap->has($link->link)) {
            //     $mon = $monitoringMap[$link->link];
            //     echo "Sudah dimonitor - ID Monitoring: {$mon->id} | Context: {$mon->context}";
            // } else {
            //     echo "Nihil";
            // }

            // echo "<br>";
        }

        echo "<br><br>";
    }



// public function index()
// {
//     $links = Link::all(); // Semua link
//     $platforms = Platform::all(); // Semua platform
//     $userId = auth()->id();

//     // Ambil semua monitoring user yang sedang login
//     $monitorings = Monitoring::where('user_id', $userId)->get();

//     // Buat mapping content => monitoring
//     $monitoringMap = $monitorings->keyBy('content');

//     foreach ($platforms as $platform) {
//         echo "<h3>Platform: {$platform->name}</h3>";

//         foreach ($links as $link) {
//             echo "Link: {$link->link} | Context: {$link->context} => ";

//             // Cek apakah link ini sudah dimonitor oleh user
//             if ($monitoringMap->has($link->link)) {
//                 $mon = $monitoringMap[$link->link];
//                 echo "Sudah dimonitor - ID Monitoring: {$mon->id} | Context: {$mon->context}";
//             } else {
//                 echo "Nihil";
//             }

//             echo "<br>";
//         }

//         echo "<br><br>";
//     }
// }


        

        // $links = [];

        // foreach($platforms as $platform){
        //     foreach($links_before as $link){
        //         echo $link->link." ".$link->context."<br><br>";
        //     }
        // }







        // $users = User::join("monitorings", "monitorings.user_id", "=", "users.id")
        // ->get();
        
        // // $link = Link::join

        // echo $users."<br><br><br>";
        
        // foreach($users as $user){
        //     echo $user;
        // }
    }
}
