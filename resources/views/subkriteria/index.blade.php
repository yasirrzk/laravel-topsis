@extends('layouts.app')
  
@section('title', 'Table SubKriteria')
  
@section('contents')
    
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Sub Kriteria</th>
                <th scope="col">Bobot</th>
                <th scope="col">Kriteria</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_kriteria as $rs)
            <tr class="bg-white">
                <td>{{ $rs->kriteria->code_kriteria }}</td>
                <td>{{ $rs->nama }}</td>
                <td>{{ $rs->kriteria->weight }}</td>
                <td class="btn" style="background-color: aquamarine">{{ $rs->kriteria->kriteria }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection