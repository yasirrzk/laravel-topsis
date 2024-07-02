@extends('layouts.app')
  
@section('title', 'Table SubKriteria')
  
@section('contents')
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th>ID Alternatif</th>
                <th>Nama Alternatif</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_kriteria as $rs)
            <tr class="bg-white">
                <td>{{ $rs->alternatif->code_alternatif }}</td>
                <td>{{ $rs->alternatif->nama }}</td>
                <td>{{ $rs->nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<br>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th>ID Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
                <th>Jenis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_kriteria as $rs)
            <tr class="bg-white">
                <td>{{ $rs->kriteria->code_kriteria }}</td>
                <td>{{ $rs->kriteria->kriteria }}</td>
                <td>{{ $rs->kriteria->weight }}</td>
                <td class="btn text-center" style="background-color: aquamarine; text-align: center">{{ $rs->kriteria->type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<br>
<br>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th>Alternatif</th>
                <th>Nama Alternatif</th>
                <th>Bobot</th>
                <th>Jenis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_kriteria as $rs)
            <tr class="bg-white">
                <td class="text-center">
                    <div class="form-group">
                        <select class="form-control">
                            <option>Pilih Jenis</option>
                            <option value="{{ $rs->alternatif->nama }}">{{ $rs->alternatif->nama }}</option>
                            <!-- Tambahkan opsi jenis lainnya jika diperlukan -->
                        </select>
                    </div>
                </td>
                <td>{{ $rs->kriteria->kriteria }}</td>
                <td>{{ $rs->kriteria->weight }}</td>
                <td class="text-center">
                    <div class="form-group">
                        <select class="form-control">
                            <option>Pilih Jenis</option>
                            <option value="{{ $rs->kriteria->type }}">{{ $rs->kriteria->type }}</option>
                            <!-- Tambahkan opsi jenis lainnya jika diperlukan -->
                        </select>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection