@extends('layouts.app')

@section('title', 'Tambah Perbaikan Buku')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Tambah Perbaikan Buku</h1>
            <a href="{{ route('repairs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('repairs.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="book_id">Pilih Buku <span class="text-danger">*</span></label>
                        <select class="form-control @error('book_id') is-invalid @enderror" id="book_id" name="book_id"
                            required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->kode_buku }} - {{ $book->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="repair_date">Tanggal Perbaikan <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('repair_date') is-invalid @enderror"
                            id="repair_date" name="repair_date" value="{{ old('repair_date') }}" min="{{ date('Y-m-d') }}"
                            required>
                        @error('repair_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi Kerusakan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="notes">Catatan Tambahan</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('repairs.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
