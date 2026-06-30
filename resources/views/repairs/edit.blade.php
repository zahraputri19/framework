@extends('layouts.app')

@section('title', 'Edit Perbaikan Buku')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Edit Perbaikan Buku</h1>
            <a href="{{ route('repairs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('repairs.update', $repair->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="book_id">Pilih Buku <span class="text-danger">*</span></label>
                        <select class="form-control @error('book_id') is-invalid @enderror" id="book_id" name="book_id"
                            required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}"
                                    {{ old('book_id', $repair->book_id) == $book->id ? 'selected' : '' }}>
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
                            id="repair_date" name="repair_date" value="{{ old('repair_date', $repair->repair_date) }}"
                            required>
                        @error('repair_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi Kerusakan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" required>{{ old('description', $repair->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                            required>
                            <option value="">-- Pilih Status --</option>
                            <option value="menunggu" {{ old('status', $repair->status) == 'menunggu' ? 'selected' : '' }}>
                                Menunggu</option>
                            <option value="proses" {{ old('status', $repair->status) == 'proses' ? 'selected' : '' }}>
                                Proses</option>
                            <option value="selesai" {{ old('status', $repair->status) == 'selesai' ? 'selected' : '' }}>
                                Selesai</option>
                            <option value="terlambat"
                                {{ old('status', $repair->status) == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="notes">Catatan Tambahan</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $repair->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('repairs.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
