@extends('layouts.app')
  
@section('title', 'Create Alternatif')
  
@section('contents')
    <h1 class="mb-0">Add Alternatif</h1>
    <hr />
    <form action="{{ route('kriteria.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="code_kriteria" class="form-control" placeholder="Kode Kriteria">
            </div>
            <div class="col">
                <input type="text" name="kriteria" class="form-control" placeholder="Nama Kriteria">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <input type="text" name="weight" class="form-control" placeholder="bobot">
            </div>
            <div class="col-6">
                <input type="text" name="type" class="form-control" placeholder="type">
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection