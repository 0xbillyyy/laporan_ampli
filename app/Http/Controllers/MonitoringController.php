<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Link;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Carbon\Carbon;


class MonitoringController extends Controller
{

    public function index()
    {
        $monitorings = Monitoring::all();
        return view('components.monitoring.index', compact('monitorings'));
    }

    public function destroy($id)
    {
        $monitoring = Monitoring::findOrFail($id);
        $monitoring->delete();

        return redirect()->route('monitoring.index')->with('success', 'Monitoring berhasil dihapus!');
    }


    public function autoSave(Request $request)
    {
        $data = $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'link' => 'required|url',
            "identity" => "required",
            // "platformId" => "required"
            // 'content' => 'required|string',
        ]);
    
        // $monitoring = Monitoring::where('user_id', auth()->id())
        //     ->where('platform_id', $data['platform_id'])
        //     // ->where('content', $data['content'])
        //     ->first();

        $link = Link::all();  // Mengambil semua data Link

        $monitoring = Monitoring::where('user_id', auth()->id())  // Mengambil link pertama dari koleksi
            ->where('content', $data["identity"])  // Mengambil link pertama dari koleksi
            ->where('platform_id', $data["platform_id"])  // Mengambil link pertama dari koleksi
            // ->where('platform_id', $data['platform_id'])
            // ->where('content', $data['content'])
            ->first();


        if ($monitoring) {
            $monitoring->update(['link' => $data['link']]);
        } else {
            $monitoring = Monitoring::create([
                'user_id' => auth()->id(),
                'platform_id' => $data['platform_id'],
                'link' => $data['link'],
                'content' => $data["identity"],
                // 'content' => $data['content'],
            ]);
        }
    
        return response()->json(['message' => 'Success', 'id' => $monitoring->id]);
    }
    


    public function create()
    {
        $links = Link::all();
        $platforms = Platform::all();
        $userId = auth()->id();
    
        // Membuat array: [context][platform_id] => monitoring
        $monitorings_by_platform = [];
    
        foreach ($links as $link) {
            foreach ($platforms as $platform) {
                $monitoring = Monitoring::where('platform_id', $platform->id)
                    ->where('user_id', $userId)
                    ->where('content', $link->link)
                    ->first();
    
                $monitorings_by_platform[$link->context][$platform->id] = $monitoring;
            }
        }
    
        return view('components.monitoring.create', compact(
            'links',
            'platforms',
            'monitorings_by_platform'
        ));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'user_id' => 'required|exists:users,id',
            'link' => 'required|url',
            'content' => 'nullable|string',
            // 'author' => 'nullable|string',
            // 'like' => 'nullable|string',
            // 'comment' => 'nullable|string',
            // 'share' => 'nullable|string',
            // 'view' => 'nullable|string',
            // 'published_at' => 'nullable|date',
        ]);

        // Simpan monitoring ke database
        Monitoring::create([
            'platform_id' => $validated['platform_id'],
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
            'link' => $validated['link'],
            'content' => $validated['content'],
            // 'author' => $validated['author'],
            // 'like' => $validated['like'],
            // 'comment' => $validated['comment'],
            // 'share' => $validated['share'],
            // 'view' => $validated['view'],
            // 'published_at' => $validated['published_at'],
        ]);

        // Redirect ke halaman monitoring
        return redirect()->route('monitoring.create')->with('success', 'Monitoring berhasil ditambahkan!');
    }

    public function convert($id){

        $tanggal = Carbon::now()->format('d-m-Y');

        $view_link_by_id = Link::where("id", $id)->first();
        $view_platforms = Platform::all();
        // return $view_link_by_id->context;
    


        $phpWord = new PhpWord();

        // Tambahkan section dan isi dokumen
        $section = $phpWord->addSection();
        $section->addText(
            "Dikirim setiap malam jam 20.00 ke Dansatsiber TNI (Dari Kasiops, TMT Jumat {$tanggal}, bentuknya seperti ini, bukan kumpulan Link lagi. Dan hanya amplifikasi link PUTIH SAJA! Bentuk tulisan bisa menyesuaikan, kalau beda tema, silakan dibedakan ditiap nomornya. Cth: laporan tgl {$tanggal})",
            [
                "name" => "Arial",
                "size" => 11,
                "color" => "FF0000",
                "bold" => true
            ]
        );
        $section->addText(
            "Kepada Yth. Bapak Panglima TNI.",
            [
                "name" => "Arial",
                "size" => 11
            ]
        );
        $section->addText(
            "Selamat malam Bapak Panglima, Melaporkan *Amplifikasi kegiatan positif TNI* sbb :",
            [
                "name" => "Arial",
                "size" => 11
            ]
        );

        $section->addText($view_link_by_id->link);

        $section->addText($view_link_by_id->context);
        foreach ($view_platforms as $view_platform) {
            $section->addText($view_platform->name."\n");
    
            $view_monitorings = Monitoring::where("platform_id", $view_platform->id)->get();
    
            foreach ($view_monitorings as $view_monitoring) {
                // Cek apakah content di monitoring cocok dengan link dari ID yang dicari
                if ($view_monitoring->content == $view_link_by_id->link) {
                    $section->addText($view_monitoring->link. "\n");
                }
            }
    
        }

        // $section->addTest(
            
        // );
        // Simpan file ke path sementara
        $fileName = 'contoh-export.docx';
        $tempFile = storage_path($fileName);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);
    
        // Kirim file ke user untuk didownload
        return response()->download($tempFile)->deleteFileAfterSend(true);
    
    }

}
