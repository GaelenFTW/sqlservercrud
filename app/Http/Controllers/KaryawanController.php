<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = DB::select('EXEC sp_get_karyawan');
        return view('karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        DB::statement('EXEC sp_insert_karyawan ?, ?, ?, ?', [
            $request->nama,
            $request->alamat,
            $request->no_telp,
            $request->jabatan
        ]);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = DB::select('SELECT * FROM karyawan WHERE id = ?', [$id]);
        $karyawan = $data[0];
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        DB::statement('EXEC sp_update_karyawan ?, ?, ?, ?, ?', [
            $id,
            $request->nama,
            $request->alamat,
            $request->no_telp,
            $request->jabatan
        ]);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::statement('EXEC sp_delete_karyawan ?', [$id]);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus!');
    }
}
