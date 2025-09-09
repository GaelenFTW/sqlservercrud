<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        // Panggil stored procedure sp_get_karyawan
        $karyawan = DB::select("EXEC sp_get_karyawan");

        return view('karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        DB::statement("EXEC sp_insert_karyawan ?, ?, ?, ?", [
            $request->nama,
            $request->no_telp,
            $request->jabatan,
            $request->alamat
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $karyawan = DB::select("EXEC sp_get_karyawan_by_id ?", [$id]);
        if (empty($karyawan)) {
            return redirect()->route('karyawan.index')->with('error', 'Karyawan tidak ditemukan.');
        }

        return view('karyawan.edit', ['karyawan' => $karyawan[0]]);
    }

    public function update(Request $request, $id)
    {
        DB::statement("EXEC sp_update_karyawan ?, ?, ?, ?, ?", [
            $id,
            $request->nama,
            $request->no_telp,
            $request->jabatan,
            $request->alamat
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::statement("EXEC sp_delete_karyawan ?", [$id]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus (soft delete).');
    }
}
