<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Scores;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function calculate()
    {
        // Ambil data dari model atau sumber data lainnya
        $kriteria = Kriteria::all();
        $alternatives = Alternatif::all();
        $scores = Scores::all();

        // Validasi data
        if ($kriteria->isEmpty() || $alternatives->isEmpty() || $scores->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Hitung pembagi
        $pembagi = [];
        foreach ($kriteria as $criterion) {
            $pembagi[$criterion->id] = 0;
            foreach ($alternatives as $alternative) {
                $value = $scores->where('subkriteria_id', $criterion->subkriteria->id)
                                ->where('alternatif_id', $alternative->id)
                                ->first()->value;
                $pembagi[$criterion->id] += pow($value, 2);
            }
            $pembagi[$criterion->id] = sqrt($pembagi[$criterion->id]);
        }

        // Normalisasi matriks
        $normalizedMatrix = [];
        foreach ($alternatives as $alternative) {
            foreach ($kriteria as $criterion) {
                $value = $scores->where('subkriteria_id', $criterion->subkriteria->id)
                                ->where('alternatif_id', $alternative->id)
                                ->first()->value;
                $normalizedMatrix[$alternative->id][$criterion->subkriteria->id] = $value / $pembagi[$criterion->id];
            }
        }

        // Pembobotan matriks normalisasi
        foreach ($alternatives as $alternative) {
            foreach ($kriteria as $criterion) {
                $normalizedMatrix[$alternative->id][$criterion->subkriteria->id] *= $criterion->nilai;
            }
        }

        // Tentukan solusi ideal positif dan negatif
        $positiveIdeal = [];
        $negativeIdeal = [];
        foreach ($kriteria as $criterion) {
            $columnValues = array_column($normalizedMatrix, $criterion->subkriteria->id);
            if ($criterion->type == 'benefit') {
                $positiveIdeal[$criterion->subkriteria->id] = max($columnValues);
                $negativeIdeal[$criterion->subkriteria->id] = min($columnValues);
            } else {
                $positiveIdeal[$criterion->subkriteria->id] = min($columnValues);
                $negativeIdeal[$criterion->subkriteria->id] = max($columnValues);
            }
        }

        // Hitung jarak ke solusi ideal positif dan negatif
        $distances = [];
        foreach ($normalizedMatrix as $alternative_id => $values) {
            $positiveDistance = 0;
            $negativeDistance = 0;
            foreach ($kriteria as $criterion) {
                $positiveDistance += pow($values[$criterion->subkriteria->id] - $positiveIdeal[$criterion->subkriteria->id], 2);
                $negativeDistance += pow($values[$criterion->subkriteria->id] - $negativeIdeal[$criterion->subkriteria->id], 2);
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
            $alternatifrangking[] = $alternatives->where('id', $alternative_id)->first();
        }

        // Simpan hasil perhitungan dalam session atau variabel
        session(['alternatifrangking' => $alternatifrangking]);

        // Redirect ke halaman hasil
        return redirect()->route('calculate.index');
    }

    public function show()
    {
        // Ambil hasil perhitungan dari session
        $alternatifrangking = session('alternatifrangking', []);

        // Tampilkan halaman hasil
        return view('calculate.index', compact('alternatifrangking'));
    }
}

