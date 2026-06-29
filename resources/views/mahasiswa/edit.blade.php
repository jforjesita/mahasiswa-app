<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f7fd;
            color: #333;
        }
        .main-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
            border: none;
            overflow: hidden;
            max-width: 480px;
            margin: 0 auto;
        }
        .card-header-custom {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
        }
        .form-label-custom {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 6px;
        }
        .form-control-custom {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 15px;
            color: #1e293b;
            transition: all 0.2s;
        }
        .form-control-custom:focus {
            background-color: #fff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }
    </style>
</head>
<body class="py-5">

    <div class="main-card">
        <div class="card-header-custom">
            <h5 class="fw-bold m-0"><i class="bi bi-pencil-square me-2"></i>Edit Data Mahasiswa</h5>
            <small class="opacity-75">Perbarui informasi mahasiswa terpilih</small>
        </div>

        <div class="p-4 bg-white">
            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3 rounded-3 mb-3 border-0" style="font-size: 14px;">
                    <ul class="m-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('mahasiswa.update', $mhs->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label-custom">NIM</label>
                    <input type="text" name="nim" class="form-control form-control-custom" value="{{ old('nim', $mhs->nim) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control form-control-custom" value="{{ old('nama', $mhs->nama) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control form-control-custom" value="{{ old('jurusan', $mhs->jurusan) }}" required>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-light fw-medium w-50 py-2 rounded-3" style="font-size: 14px;">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary fw-medium w-50 py-2 rounded-3 shadow-sm" style="font-size: 14px;">
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>