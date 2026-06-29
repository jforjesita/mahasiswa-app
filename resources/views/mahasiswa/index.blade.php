<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
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
        .search-input {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
        }
        .search-input:focus {
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }
        .avatar-circle {
            width: 40px;
            height: 40px;
            background-color: #e0f2fe;
            color: #0369a1;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 14px;
        }
        /* Variasi warna random untuk avatar agar lebih estetik */
        .mhs-item:nth-child(2n) .avatar-circle { background-color: #dcfce7; color: #15803d; }
        .mhs-item:nth-child(3n) .avatar-circle { background-color: #fef9c3; color: #a16207; }
        .mhs-item:nth-child(4n) .avatar-circle { background-color: #f3e8ff; color: #7e22ce; }

        .mhs-item {
            border-bottom: 1px solid #f1f5f9;
            padding: 14px 20px;
            transition: background 0.2s;
        }
        .mhs-item:last-child {
            border-bottom: none;
        }
        .mhs-item:hover {
            background-color: #f8fafc;
        }
        .mhs-name {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 2px;
            color: #1e293b;
        }
        .mhs-major {
            font-size: 13px;
            color: #64748b;
        }
        .mhs-nim {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 500;
        }
        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s;
            border: none;
        }
        .btn-edit-custom {
            background-color: #eff6ff;
            color: #2563eb;
        }
        .btn-edit-custom:hover {
            background-color: #2563eb;
            color: #fff;
        }
        .btn-delete-custom {
            background-color: #fef2f2;
            color: #dc2626;
        }
        .btn-delete-custom:hover {
            background-color: #dc2626;
            color: #fff;
        }
    </style>
</head>
<body class="py-5">

    <div class="main-card">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold m-0">Daftar Mahasiswa</h5>
                <small class="opacity-75">{{ $mahasiswa->count() }} data terdaftar</small>
            </div>
            <button class="btn btn-light btn-sm fw-semibold px-3 py-2 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-1"></i> Tambah
            </button>
        </div>

        <div class="p-3 bg-white">
            @if(session('success'))
                <div class="alert alert-success py-2 px-3 rounded-3 mb-3 border-0" style="background-color: #dcfce7; color: #15803d; font-size: 14px;">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3 rounded-3 mb-3 border-0" style="font-size: 14px;">
                    <ul class="m-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <input type="text" class="form-control search-input" placeholder="Cari mahasiswa...">
            </div>
        </div>

        <div class="d-flex flex-column bg-white">
            @forelse($mahasiswa as $mhs)
                @php
                    // Mengambil 2 huruf inisial nama awal
                    $words = explode(' ', $mhs->nama);
                    $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                @endphp
                <div class="mhs-item d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-circle">
                            {{ $initials }}
                        </div>
                        <div>
                            <div class="mhs-name">{{ $mhs->nama }} <span class="mhs-nim">({{ $mhs->nim }})</span></div>
                            <div class="mhs-major">{{ $mhs->jurusan }}</div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn-action btn-edit-custom" title="Edit">
                            <i class="bi bi-pencil-fill" style="font-size: 13px;"></i>
                        </a>
                        <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete-custom" title="Hapus">
                                <i class="bi bi-x-lg" style="font-size: 13px; -webkit-text-stroke: 0.5px;"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-folder2-open display-6 mb-2 d-block text-opacity-50"></i>
                    Belum ada data mahasiswa.
                </div>
            @endforelse
        </div>
        
        <div class="text-center py-3 bg-white border-top border-light">
            <span class="badge bg-primary rounded-pill px-2" style="height: 6px; width: 24px; padding:0 !important; display:inline-block;"></span>
            <span class="bg-secondary bg-opacity-25 rounded-pill d-inline-block mx-1" style="height: 6px; width: 6px;"></span>
            <span class="bg-secondary bg-opacity-25 rounded-pill d-inline-block" style="height: 6px; width: 6px;"></span>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 14px;">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-bold" id="exampleModalLabel">Tambah Mahasiswa Baru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">NIM</label>
                            <input type="text" name="nim" class="form-control py-2" placeholder="Masukkan NIM" value="{{ old('nim') }}" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control py-2" placeholder="Masukkan Nama" value="{{ old('nama') }}" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small fw-semibold text-muted">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control py-2" placeholder="Masukkan Jurusan" value="{{ old('jurusan') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light btn-sm fw-medium px-3" data-bs-toggle="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-medium px-4">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>