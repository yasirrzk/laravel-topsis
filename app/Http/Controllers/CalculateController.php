<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;

class CalculateController extends Controller
{
    public function topsis()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        // Normalisasi Matriks
        $matrixNormalisasi = [];
        $pembagi = [];

        foreach ($kriterias as $kriteria) {
            $nilaiKriteria = $penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai')->toArray();
            if (!empty($nilaiKriteria)) {
                $pembagi[$kriteria->id] = sqrt(array_sum(array_map(function($nilai) {
                    return pow($nilai, 2);
                }, $nilaiKriteria)));
            } else {
                $pembagi[$kriteria->id] = 1; // Default value to avoid division by zero
            }
        }

        foreach ($penilaians as $penilaian) {
            $matrixNormalisasi[$penilaian->alternatif_id][$penilaian->kriteria_id] = $penilaian->nilai / $pembagi[$penilaian->kriteria_id];
        }

        // Matriks Normalisasi Terbobot
        $matrixTerbobot = [];
        foreach ($matrixNormalisasi as $altId => $nilai) {
            foreach ($nilai as $kriId => $nilaiNormalisasi) {
                $matrixTerbobot[$altId][$kriId] = $nilaiNormalisasi * $kriterias->find($kriId)->weight;
            }
        }

        // Solusi Ideal Positif dan Negatif
        $solusiIdealPositif = [];
        $solusiIdealNegatif = [];
        foreach ($kriterias as $kriteria) {
            $values = array_column($matrixTerbobot, $kriteria->id);
            $filteredValues = array_filter($values, function($val) {
                return $val !== null;
            });

            if (!empty($filteredValues)) {
                $solusiIdealPositif[$kriteria->id] = ($kriteria->type == 'Benefit') ? max($filteredValues) : min($filteredValues);
                $solusiIdealNegatif[$kriteria->id] = ($kriteria->type == 'Benefit') ? min($filteredValues) : max($filteredValues);
            } else {
                $solusiIdealPositif[$kriteria->id] = 0; // Default value if no data
                $solusiIdealNegatif[$kriteria->id] = 0; // Default value if no data
            }
        }
        // Jarak Solusi Ideal Positif dan Negatif
        $jarakPositif = [];
        $jarakNegatif = [];
        foreach ($alternatifs as $alternatif) {
            $jarakPositif[$alternatif->id] = sqrt(array_sum(array_map(function($kriId) use ($matrixTerbobot, $solusiIdealPositif, $alternatif) {
                return pow($matrixTerbobot[$alternatif->id][$kriId] - $solusiIdealPositif[$kriId], 2);
            }, array_keys($solusiIdealPositif))));
            
            $jarakNegatif[$alternatif->id] = sqrt(array_sum(array_map(function($kriId) use ($matrixTerbobot, $solusiIdealNegatif, $alternatif) {
                return pow($matrixTerbobot[$alternatif->id][$kriId] - $solusiIdealNegatif[$kriId], 2);
            }, array_keys($solusiIdealNegatif))));
        }

        // Nilai Preferensi
        $nilaiPreferensi = [];
        foreach ($alternatifs as $alternatif) {
            $nilaiPreferensi[$alternatif->id] = $jarakNegatif[$alternatif->id] / ($jarakPositif[$alternatif->id] + $jarakNegatif[$alternatif->id]);
        }

        // Perankingan
        arsort($nilaiPreferensi);

        return view('perhitungan.calculate', compact('alternatifs', 'kriterias', 'matrixNormalisasi', 'matrixTerbobot', 'solusiIdealPositif', 'solusiIdealNegatif', 'jarakPositif', 'jarakNegatif', 'nilaiPreferensi'));
    }
}
