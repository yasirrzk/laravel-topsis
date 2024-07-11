@extends('layouts.app')
  
@section('title', 'Edit Product')
  
@section('contents')
    <h1 class="mb-0">Edit Product</h1>
    <hr />
    <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Kode Kriteria</label>
                <input type="text" name="code_kriteria" class="form-control" placeholder="Kode Kriteria" value="{{ $kriteria->code_kriteria }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Nama Kritreria</label>
                <input type="text" name="kriteria" class="form-control" placeholder="Nama Kriteria" value="{{ $kriteria->kriteria}}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Bobot</label>
                <input type="text" name="weight" class="form-control" placeholder="Bobot" value="{{ $kriteria->weight}}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Jenis</label>
                <input type="text" name="type" class="form-control" placeholder="Jenis" value="{{ $kriteria->type}}" >
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection