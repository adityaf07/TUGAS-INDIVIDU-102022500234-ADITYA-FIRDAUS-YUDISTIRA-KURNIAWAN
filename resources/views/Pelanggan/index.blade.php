<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Modul Data Pelanggan</title>
</head>
<body>
<div class="container">
    <h1>Data Pelanggan</h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
    <span>Login sebagai: <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role }})</span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
    </form>
</div>
    <div class="card-custom">

        {{-- Tambah: admin & staff --}}
        @can('create', App\Models\Pelanggan::class)
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-4">+ Tambah Data</a>
        @endcan

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No.Telpon</th>
                        <th>Catatan</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pelanggan as $p)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->notelp }}</td>
                        <td>{{ $p->catatan }}</td>
                        <td class="text-center">

                            {{-- Detail: semua role --}}
                            <button type="button" class="btn btn-secondary text-light btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#detail{{ $p->id_pelanggan }}">Detail</button>

                            {{-- Edit: admin & staff --}}
                            @can('update', $p)
                                <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}"
                                   class="btn btn-warning btn-sm">Edit</a>
                            @endcan

                            {{-- Hapus: admin saja --}}
                            @can('delete', $p)
                                <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah anda yakin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            @endcan

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Detail (di luar tabel agar HTML valid) --}}
@foreach ($pelanggan as $p)
    <div class="modal fade" id="detail{{ $p->id_pelanggan }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> {{ $p->nama }}</p>
                    <p><strong>Alamat:</strong> {{ $p->alamat }}</p>
                    <p><strong>No. Telpon:</strong> {{ $p->notelp }}</p>
                    <p><strong>Catatan:</strong> {{ $p->catatan }}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>