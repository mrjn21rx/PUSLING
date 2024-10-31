<?php

namespace App\Controllers;

use App\Models\Permohonan; // Pastikan Anda mengimpor model
use CodeIgniter\Controller;

class PermohonanController extends Controller
{
    // Menampilkan form pengajuan
    public function create()
    {
        return view('beranda'); // Mengarahkan ke tampilan beranda yang berisi form
    }

    // Menyimpan pengajuan
    public function store()
    {
        $data = [
            'nama_institusi' => $this->request->getPost('nama_institusi'),
            'waktu_pusling' => $this->request->getPost('waktu_pusling'),
            'dokumen_permohonan' => $this->request->getFile('dokumen_permohonan')->store(),
            'email' => $this->request->getPost('email'),
            'status' => 'Pending', // Status awal
        ];

        $permohonan = new Permohonan($data);
        $permohonan->save(); // Simpan data ke database

        return redirect()->to('/dashboard'); // Arahkan ke dashboard setelah menyimpan
    }
}
