<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function hitungSelisihTanggal()
    {
        $tanggalKejadian = Carbon::parse($this->tanggal);
        $tanggalSekarang = Carbon::now();

        $selisihHari = $tanggalSekarang->diffInDays($tanggalKejadian);

        return $selisihHari;
    }

    public function pengadu()
    {
        return $this->belongsTo(Pengadu::class, 'pengadu_id');
    }
}
