<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function calculate()
    {
        // Ambil data dari model atau sumber data lainnya
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $subkriteria = SubKriteria::all();

        // Validasi data
        if ($kriteria->isEmpty() || $alternatif->isEmpty() || $subkriteria->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Hitung pembagi
        $pembagi = [];
        foreach ($kriteria as $criterion) {
            $pembagi[$criterion->id] = 0;
            foreach ($alternatif as $alternative) {
                $value = $subkriteria->where('subkriteria_id', $criterion->id)
                                ->where('alternatif_id', $alternative->id)
                                ->first()->value;
                $pembagi[$criterion->id] += pow($value, 2);
            }
            $pembagi[$criterion->id] = sqrt($pembagi[$criterion->id]);
        }

        // Normalisasi matriks
        $normalizedMatrix = [];
        foreach ($alternatif as $alternative) {
            foreach ($kriteria as $criterion) {
                $value = $subkriteria->where('subkriteria_id', $criterion->id)
                                ->where('alternatif_id', $alternative->id)
                                ->first()->value;
                $normalizedMatrix[$alternative->id][$criterion->id] = $value / $pembagi[$criterion->id];
            }
        }

        // Pembobotan matriks normalisasi
        $weightedNormalizedMatrix = $normalizedMatrix;
        foreach ($alternatif as $alternative) {
            foreach ($kriteria as $criterion) {
                $weightedNormalizedMatrix[$alternative->id][$criterion->id] *= $criterion->weight;
            }
        }

        // Tentukan solusi ideal positif dan negatif
        $positiveIdeal = [];
        $negativeIdeal = [];
        foreach ($kriteria as $criterion) {
            $columnValues = array_column(array_column($weightedNormalizedMatrix, $criterion->id), $criterion->id);
            if ($criterion->type == 'benefit') {
                $positiveIdeal[$criterion->id] = max($columnValues);
                $negativeIdeal[$criterion->id] = min($columnValues);
            } else {
                $positiveIdeal[$criterion->id] = min($columnValues);
                $negativeIdeal[$criterion->id] = max($columnValues);
            }
        }

        // Hitung jarak ke solusi ideal positif dan negatif
        $distances = [];
        foreach ($weightedNormalizedMatrix as $alternative_id => $values) {
            $positiveDistance = 0;
            $negativeDistance = 0;
            foreach ($kriteria as $criterion) {
                $positiveDistance += pow($values[$criterion->id] - $positiveIdeal[$criterion->id], 2);
                $negativeDistance += pow($values[$criterion->id] - $negativeIdeal[$criterion->id], 2);
            }
            $distances[$alternative_id]['positive'] = sqrt($positiveDistance);
            $distances[$alternative_id]['negative'] = sqrt($negativeDistance);
        }

        // Hitung nilai preferensi untuk setiap alternatif
        $preferences = [];
        foreach ($distances as $alternative_id => $distance) {
            $preferences[$alternative_id] = $distance['negative'] / ($distance['positive'] + $distance['negative']);
        }

        // Lakukan peringkat alternatif
        arsort($preferences);
        $alternatifrangking = [];
        foreach ($preferences as $alternative_id => $preference) {
            $alternatifrangking[] = $alternatif->where('id', $alternative_id)->first();
        }

        // Simpan hasil perhitungan dalam session atau variabel
        session([
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'subkriteria' => $subkriteria,
            'pembagi' => $pembagi,
            'normalizedMatrix' => $normalizedMatrix,
            'weightedNormalizedMatrix' => $weightedNormalizedMatrix,
            'positiveIdeal' => $positiveIdeal,
            'negativeIdeal' => $negativeIdeal,
            'preferences' => $preferences,
            'alternatifrangking' => $alternatifrangking
        ]);

        // Redirect ke halaman hasil
        return redirect()->route('calculate.show');
    }

    public function show()
    {
        // Ambil hasil perhitungan dari session
        $alternatif = session('alternatif', []);
        $kriteria = session('kriteria', []);
        $scores = session('scores', []);
        $pembagi = session('pembagi', []);
        $normalizedMatrix = session('normalizedMatrix', []);
        $weightedNormalizedMatrix = session('weightedNormalizedMatrix', []);
        $positiveIdeal = session('positiveIdeal', []);
        $negativeIdeal = session('negativeIdeal', []);
        $preferences = session('preferences', []);
        $alternatifrangking = session('alternatifrangking', []);

        // Tampilkan halaman hasil
        return view('calculate.index', compact(
            'alternatif', 'kriteria', 'scores', 'pembagi', 'normalizedMatrix', 
            'weightedNormalizedMatrix', 'positiveIdeal', 'negativeIdeal', 
            'preferences', 'alternatifrangking'
        ));
    }
}
