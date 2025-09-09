<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data Karyawan</h2>
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>

    <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-3">+ Tambah Karyawan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telp</th>
                <th>Jabatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($karyawan as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->alamat }}</td>
                    <td>{{ $row->no_telp }}</td>
                    <td>{{ $row->jabatan }}</td>
                    <td>
                        <a href="{{ route('karyawan.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('karyawan.destroy', $row->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Confirm?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
