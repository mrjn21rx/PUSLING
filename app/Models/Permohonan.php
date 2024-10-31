<?php

namespace App\Controllers;

use App\Models\Permohonan; // Pastikan Anda mengimpor model
use CodeIgniter\Controller;

class PermohonanController extends Controller
{
    // Menampilkan beranda dengan daftar permohonan
    public function index()
    {
        // Mengambil semua data permohonan dari database
        $permohonanModel = new Permohonan();
        $data['permohonan'] = $permohonanModel->findAll(); // Mengambil semua data

        return view('beranda', $data); // Mengarahkan ke tampilan beranda dan mengirim data permohonan
    }

    // Menampilkan form pengajuan
    public function create()
    {
        return view('form_permohonan'); // Mengarahkan ke tampilan form pengajuan
    }

    // Menyimpan pengajuan
    public function store()
    {
        $data = [
            'nama_institusi' => $this->request->getPost('nama_institusi'),
            'waktu_pusling' => $this->request->getPost('waktu_pusling'),
            'dokumen_permohonan' => $this->request->getFile('dokumen_permohonan')->store(), // Pastikan file berhasil diupload
            'email' => $this->request->getPost('email'),
            'status' => 'Pending', // Status awal
        ];

        $permohonanModel = new Permohonan(); // Buat instance model
        $permohonanModel->save($data); // Simpan data ke database

        return redirect()->to('/dashboard')->with('success', 'Permohonan berhasil disimpan.'); // Arahkan ke dashboard setelah menyimpan dengan pesan sukses
    }
}
