@extends('layouts.app')

@section('title', 'Data Perbaikan Buku')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Data Perbaikan Buku</h1>
            @auth
                @if (Auth::user()->isAdmin() || Auth::user()->isMember())
                    <a href="{{ route('repairs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Perbaikan
                    </a>
                @endif
            @endauth
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Petugas</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Batas Waktu</th>
                                <th>Status</th>
                                <th>Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($repairs as $index => $repair)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $repair->book->kode_buku }}</td>
                                    <td>{{ $repair->book->judul }}</td>
                                    <td>{{ $repair->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($repair->repair_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($repair->deadline_date)->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($repair->status === 'menunggu')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($repair->status === 'proses')
                                            <span class="badge badge-info">Proses</span>
                                        @elseif($repair->status === 'selesai')
                                            <span class="badge badge-success">Selesai</span>
                                        @elseif($repair->status === 'terlambat')
                                            <span class="badge badge-danger">Terlambat</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($repair->fine_amount, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>

                                        @if ($repair->status !== 'selesai')
                                            <form action="{{ route('repairs.complete', $repair->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    onclick="return confirm('Tandai perbaikan ini sebagai selesai?')">
                                                    <i class="fas fa-check"></i> Selesai
                                                </button>
                                            </form>
                                        @endif

                                        @auth
                                            @if (Auth::user()->isAdmin())
                                                <a href="{{ route('repairs.edit', $repair->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('repairs.destroy', $repair->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data perbaikan ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data perbaikan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $repairs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
