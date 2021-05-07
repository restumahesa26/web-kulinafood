<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function pesanan()
    {
        $data = Transaction::where('packet_status', 'Sampai Tujuan')->get();

        $pdf = PDF::loadview('pages.laporan.pesanan_laporan', [
            'data' => $data
        ]);
        return $pdf->download('laporan-pesanan-pdf');
    }
}
