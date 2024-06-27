@extends('layouts.app')

@section('title', 'Calculate')

@section('content')
<div class="container">
    <h1>Hasil Perhitungan TOPSIS</h1>

    @if(isset($normalizedMatrix) && isset($positiveIdeal) && isset($negativeIdeal) && isset($distances) && isset($preferences))
        <h2>Normalisasi Matriks</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach($kriteria as $criterion)
                        @foreach($criterion->subkriteria as $subcriterion)
                            <th>{{ $subcriterion->nama }}</th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($alternatives as $alternative)
                    <tr>
                        <td>{{ $alternative->nama }}</td>
                        @foreach($normalizedMatrix[$alternative->id] as $value)
                            <td>{{ number_format($value, 4) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Solusi Ideal Positif dan Negatif</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Subkriteria</th>
                    <th>Ideal Positif</th>
                    <th>Ideal Negatif</th>
                </tr>
            </thead>
            <tbody>
                @foreach($positiveIdeal as $subkriteria_id => $positiveValue)
                    @php
                        $subkriteria = \App\Models\SubKriteria::find($subkriteria_id);
                    @endphp
                    <tr>
                        <td>{{ $subkriteria->nama }}</td>
                        <td>{{ number_format($positiveValue, 4) }}</td>
                        <td>{{ number_format($negativeIdeal[$subkriteria_id], 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Jarak ke Solusi Ideal Positif dan Negatif</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Jarak ke Ideal Positif</th>
                    <th>Jarak ke Ideal Negatif</th>
                </tr>
            </thead>
            <tbody>
                @foreach($distances as $alternative_id => $distance)
                    @php
                        $alternative = \App\Models\Alternatif::find($alternative_id);
                    @endphp
                    <tr>
                        <td>{{ $alternative->nama }}</td>
                        <td>{{ number_format($distance['positive'], 4) }}</td>
                        <td>{{ number_format($distance['negative'], 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Nilai Preferensi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai Preferensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($preferences as $alternative_id => $preference)
                    @php
                        $alternative = \App\Models\Alternatif::find($alternative_id);
                    @endphp
                    <tr>
                        <td>{{ $alternative->nama }}</td>
                        <td>{{ number_format($preference, 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Data tidak lengkap untuk melakukan perhitungan TOPSIS.</p>
    @endif
</div>
@endsection
