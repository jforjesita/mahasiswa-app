<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h3>Aplikasi Daftar Mahasiswa (MVC)</h3>
    <hr>

    <!-- Form Tambah Data -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col"><input type="text" name="nim" class="form-control" placeholder="NIM" required></div>
                    <div class="col"><input type="text" name="nama" class="form-control" placeholder="Nama" required></div>
                    <div class="col"><input type="text" name="jurusan" class="form-control" placeholder="Jurusan" required></div>
                    <div class="col"><button type="submit" class="btn btn-primary">Tambah</button></div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $m)
            <tr>
                <td>{{ $m->nim }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->jurusan }}</td>
                <td>
                    <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>