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
        // $users = User::with(['monitorings.platform'])->get();
        // $platforms = ['Instagram', 'TikTok', 'Twitter', 'Facebook'];
        // $links = Link::all();
        
        $platforms = Platform::all(); // Untuk header
        $links = Link::with('platform')->get();
    
        // Buat grup berdasarkan orang/context
        $groupedLinks = [];
    
        echo "
        <table border='1' cellspacing='0' cellpadding='5'>
            <thead>
                <tr>
                    <th rowspan='2'>No</th>
                    <th colspan='2'>Nama</th>
                </tr>
                <tr>
                    <th rowspan='2'>No</th>
                    <th colspan='2'>Nama</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        ";
        

        // foreach ($links as $link) {
        //     $context = $link->context;
    
        //     if (!isset($groupedLinks[$context])) {
        //         $groupedLinks[$context] = [
        //             'nama' => $context,
        //             'pangkat' => 'Letda Cke', // misal hardcoded atau ambil dari DB
        //             'links' => [],
        //         ];
        //     }
    
        //     $groupedLinks[$context]['links'][$link->platform->name] = $link->link;
        // }
    
        // return view('tabel-dinamis', compact('platforms', 'groupedLinks'));
        







        // echo "<table border='1' cellpadding='8' cellspacing='0'>";
        // echo "<thead>";


        // // echo "<tr>";
        // // echo "<td rowspan='3'>No</td>";
        // // echo "</tr>";
        // echo "
        // <table border='1' cellspacing='0' cellpadding='5'>
        //     <tr>
        //         <th rowspan='2'>NO</th>
        //         <th rowspan='2'>NAMA</th>
        //         <th rowspan='2'>Pangkat, Korps</th>
        // ";
        
        // $no = 1;
        // foreach ($links as $link) {
        //     echo "                <th colspan='4' style='background-color: yellow;'>BIDANG POSITIF TNI</th>
        //     </tr>
        //     <tr>
        //         <th colspan='4'>LINK VIDEO :</th>
        //     </tr>";
        //     echo "<tr>
        //         <td>{$no}</td>
        //         <td>{$link['nama']}</td>
        //         <td>{$link['pangkat']}</td>
        //         <td><a href='{$link['instagram']}'>Instagram</a></td>
        //         <td><a href='{$link['tiktok']}'>TikTok</a></td>
        //         <td><a href='{$link['twitter']}'>Twitter</a></td>
        //         <td><a href='{$link['facebook']}'>Facebook</a></td>
        //     </tr>";
        //     $no++;
        // }
        // // echo "<tr>";
        // // echo    "<th>No</th>
        // //         <th rowspan='3'>Nama</th>";
        // //         foreach ($platforms as $platform) {
        // //             echo "<th>$platform</th>";
        // //         }
        // // echo "</tr>";

        
        // echo "</thead>";
        // echo "<tbody>";

        // $no = 1;
        // foreach ($users as $user) {
        //     echo "<tr>";
        //     echo "<td>{$no}</td>";
        //     echo "<td>{$user->name}</td>";


        //     $links = Link::all();
            
        //     foreach($links as $link){
        //         foreach ($platforms as $platformName) {
        //             // Cari monitoring yang platform-nya sesuai
        //             $link = $user->monitorings
        //                 ->filter(fn($m) => strtolower($m->platform->name) === strtolower($platformName))
        //                 ->first();

        //             if ($link && $link->content) {
        //                 echo "<td>{$link->link}: <a href='{$link->link}' target='_blank'>{$link->link}</a></td>";
        //             } else {
        //                 echo "<td>-</td>";
        //             }
        //         }
        //     }

        //     echo "</tr>";
        //     $no++;
        // }

        // echo "</tbody></table>";
    
}





    // ini bener by user_id/////////////////////////
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
    //             $monitorings_by_platform = Monitoring::where('platform_id', $platform->id)
    //             ->where("user_id", $userId)
    //             ->where("content", $link->link)
    //             ->first();

    //             // echo "Link: {$link->link} | Context: {$link->context} => ";

    //             if ($monitorings_by_platform) {
    //                 echo $monitorings_by_platform->id;
    //                 echo "<br>";
    //             } else {
    //                 echo "No monitoring data found";
    //                 echo "<br>";

    //             }
    //         }

    //         echo "<br><br>";
    //     }
    // }
}
