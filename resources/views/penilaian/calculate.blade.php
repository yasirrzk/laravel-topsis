@extends('layouts.app')

@section('contents')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Perhitungan SAW') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h4>Matriks Penilaian</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->kriteria}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>{{ $alternatif->nama}}</td>
                                @foreach ($kriterias as $kriteria)
                                    <td>{{ $matrixPenilaian[$alternatif->id][$kriteria->id] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h4>Matriks Normalisasi</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->kriteria}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>{{ $alternatif->nama}}</td>
                                @foreach ($kriterias as $kriteria)
                                    <td>{{ number_format($matrixNormalisasi[$alternatif->id][$kriteria->id], 4) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h4>Nilai Preferensi</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiPreferensi as $altId => $nilai)
                            <tr>
                                <td>{{ $alternatifs->find($altId)->nama}}</td>
                                <td>{{ number_format($nilai, 4) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
