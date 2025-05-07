<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\home;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\TestingController;
use Illuminate\Support\Facades\Auth;



use App\Models\Monitoring;
use App\Models\Link;
use App\Models\Platform;

Route::get('/', function () {
    return redirect("/login");
});

// Route::get('/dashboard', function () {
    
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', "verified", 'role:admin'])->group(function () {
    Route::get('/awok', function(){
        echo "sip";
    })->name('admin.dashboard');
});

Route::middleware(["auth", "verified"])->group(function(){
    // Route::post('/autosave-monitoring', [MonitoringController::class, 'autoSave']);
    Route::match(['post', 'put'], '/autosave-monitoring', [MonitoringController::class, 'autoSave'])->name('autosave-monitoring');


    Route::get("/awok/{id}/{link}", function($user_id, $link){
                // $monitoring = Monitoring::where('user_id', auth()->id())
        // ->where('platform_id', $data['platform_id'])
        // // ->where('content', $data['content'])
        // ->first();
        $monitoring = Monitoring::where('content', auth()->id()."-".$link)
        // ->where('platform_id', $data['platform_id'])
        // ->where('content', $data['content'])
        ->first();
        echo $monitoring;
        // echo auth()->id();
        // echo $link;
    });


    Route::get("/dashboard", [home::class, "index"])->name("dashboard");

    // Route::get("/category_platform/create", [CategoryPlatformController::class, "create"])->name("create_category_platform");

    //platform category

    Route::middleware(["auth", "verified", "role:admin"])->group(function(){

        Route::get('/platform/index', [PlatformController::class, 'index'])->name('platform.index');
        Route::get('/platform/create', [PlatformController::class, 'create'])->name('platform.create');
        Route::post('/platform/store', [PlatformController::class, 'store'])->name('platform.store');
        Route::delete('/platform/{platform}', [PlatformController::class, 'destroy'])->name('platform.destroy');


        Route::get('/link/create', [LinkController::class, 'create'])->name('link.create');
        Route::post('/link/store', [LinkController::class, 'store'])->name('link.store');
        Route::get('/link/index', [LinkController::class, 'index'])->name('link.index');
        Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');


        Route::get("/export/word/{id}", [MonitoringController::class, "convert"])->name("convert.docx");
        Route::get("/export", [MonitoringController::class, "view_export"])->name("export");


        Route::get("/users", [UserController::class, "index"])->name("users");
        Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');


    });
    
    // Route::middleware(["auth", "verified", "role:admin"])->group(function(){

    // });
    
    // Route::middleware(["auth", "verified", "role:admin"])->group(function(){
    // });

    Route::get('/monitoring/create', [MonitoringController::class, 'create'])->name('monitoring.create');
    Route::post('/monitoring/store', [MonitoringController::class, 'store'])->name('monitoring.store');
    Route::get('/monitoring/index', [MonitoringController::class, 'index'])->name('monitoring.index');
    Route::delete('/monitoring/{id}', [MonitoringController::class, 'destroy'])->name('monitoring.destroy');

    Route::get('/dashboard/logout', [UserController::class, 'logout'])->name('dashboard.logout');

    Route::get("/testing", [TestingController::class, "index"])->name("testing");



    // Route::prefix('monitoring')->name('monitoring.')->group(function () {
        // Route::get('/', [MonitoringController::class, 'index'])->name('index'); // Daftar Monitoring
        // Route::get('/create', [MonitoringController::class, 'create'])->name('create'); // Halaman Create Monitoring
        // Route::post('/', [MonitoringController::class, 'store'])->name('store'); // Menyimpan Monitoring
        // Route::delete('/{id}', [MonitoringController::class, 'destroy'])->name('destroy'); // Menghapus Monitoring
    // });

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
