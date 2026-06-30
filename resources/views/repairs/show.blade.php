@extends('layouts.app')

@section('title', 'Detail Perbaikan Buku')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Detail Perbaikan Buku</h1>
            <a href="{{ route('repairs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Informasi Perbaikan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Kode Buku</th>
                                <td>: {{ $repair->book->kode_buku }}</td>
                            </tr>
                            <tr>
                                <th>Judul Buku</th>
                                <td>: {{ $repair->book->judul }}</td>
                            </tr>
                            <tr>
                                <th>Penulis</th>
                                <td>: {{ $repair->book->penulis }}</td>
                            </tr>
                            <tr>
                                <th>Petugas</th>
                                <td>: {{ $repair->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Perbaikan</th>
                                <td>: {{ \Carbon\Carbon::parse($repair->repair_date)->format('d/m/Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Batas Waktu</th>
                                <td>: {{ \Carbon\Carbon::parse($repair->deadline_date)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:
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
                            </tr>
                            <tr>
                                <th>Denda</th>
                                <td>: Rp {{ number_format($repair->fine_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Status Pembayaran</th>
                                <td>:
                                    @if ($repair->payment_status === 'belum_bayar')
                                        <span class="badge badge-danger">Belum Bayar</span>
                                    @elseif($repair->payment_status === 'lunas')
                                        <span class="badge badge-success">Lunas</span>
                                    @else
                                        <span class="badge badge-secondary">Tidak Ada</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <table class="table table-borderless">
                            <tr>
                                <th width="15%">Deskripsi Kerusakan</th>
                                <td>: {{ $repair->description }}</td>
                            </tr>
                            <tr>
                                <th>Catatan Tambahan</th>
                                <td>: {{ $repair->notes ?: '-' }}</td>
                            </tr>
                            @if ($repair->completion_date)
                                <tr>
                                    <th>Tanggal Selesai</th>
                                    <td>: {{ \Carbon\Carbon::parse($repair->completion_date)->format('d/m/Y') }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    @if ($repair->status !== 'selesai')
                        <form action="{{ route('repairs.complete', $repair->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success"
                                onclick="return confirm('Tandai perbaikan ini sebagai selesai?')">
                                <i class="fas fa-check"></i> Tandai Selesai
                            </button>
                        </form>
                    @endif

                    @auth
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('repairs.destroy', $repair->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus data perbaikan ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
