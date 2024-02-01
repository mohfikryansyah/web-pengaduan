<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use App\Models\Pengadu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function sendEmail(Pengaduan $id)
    {
        if ($id['status'] == 'Baru') {
            $id['status'] = 'Sedang diproses';
            $id->save();
            $infoMail = [
                'nama' => $id->pengadu->nama,
                'judul' => $id->judul,
                'status' => 'sedang kami proses',
            ];
        } else {
            $id['status'] = 'Selesai diproses';
            $id['tanggal_selesai'] = Carbon::today();
            $id['durasi'] = $id->hitungSelisihTanggal();
            $id->save();
            $infoMail = [
                'nama' => $id->pengadu->nama,
                'judul' => $id->judul,
                'status' => 'selesai kami proses',
            ];
        }

        Mail::to($id->pengadu->email)->send(new SendMail($infoMail));

        return redirect('/dashboard')->with('success', 'Berhasil mengirim notifikasi!');
    }

    public function tolakEmail(Pengaduan $id)
    {
        $id['status'] = 'Ditolak';
        $id->save();
        $infoMail = [
            'nama' => $id->pengadu->nama,
            'judul' => $id->judul,
            'status' => 'ditolak',
        ];

        Mail::to($id->pengadu->email)->send(new SendMail($infoMail));

        return redirect('/dashboard')->with('success', 'Berhasil mengirim notifikasi!');
    }

    public function index(Request $request)
    {
        $tahun = $request->input('tahun');

        if ($tahun == 'all') {
            $data = Pengaduan::paginate(10);
        } else {
            $data = Pengaduan::where('tanggal', 'like', '%' . $tahun . '%')->get();
        }

        return view('master.layouts.dashboard-tabel', [
            'pengaduan' => $data,
            'title' => 'Dashboard',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pengadu = $request->validate([
            'nama' => 'required',
            'email' => 'required',
        ]);

        Pengadu::create($pengadu);
        // dd($request->all());
        $rules = $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required',
            'pesan' => 'required|max:255',
            'tanggal' => 'required',
            'lokasi' => 'required|max:255',
            'file_input' => 'required|mimes:pdf,jpg,jpeg,png|file|max:2048',
        ]);


        $rules['pengadu_id'] = Pengadu::pluck('id')->last();
        $rules['file_input'] = $request->file('file_input')->store('bukti');
        $rules['status'] = 'Baru';
        // dd($rules);
        Pengaduan::create($rules);

        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengaduan $dashboard)
    {
        $getID = Pengaduan::findOrFail($dashboard->id);
        // dd($getID);
        $getID['status'] = 'Sudah di proses';
        $getID->save();
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
    }
}
