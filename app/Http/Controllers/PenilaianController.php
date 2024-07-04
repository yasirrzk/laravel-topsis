<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        return view('penilaian.index', compact('alternatifs', 'kriterias', 'penilaians'));
    }

    public function create()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        return view('penilaian.create', compact('alternatifs', 'kriterias'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $alternativeId = $request->input('alternatif_id');

        DB::beginTransaction();
        foreach ($data as $key => $value) {
            if ($key != 'alternatif_id') {
                Penilaian::updateOrCreate(
                    ['alternatif_id' => $alternativeId, 'kriteria_id' => $key],
                    ['nilai' => $value]
                );
            }
        }
        DB::commit();

        return redirect()->route('penilaian.index')->with('toast_success', 'Penilaian alternatif diperbarui!');
    }

    public function getForms(Request $request)
    {
        $id = $request->id;
        $forms = Penilaian::with(['alternatif', 'kriteria'])
            ->where('alternatif_id', $id)
            ->get();

        $alternatif = Alternatif::find($id);
        $kriterias = Kriteria::all();

        return view('penilaian.edit', compact('forms', 'alternatifs', 'kriterias'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'alternatif_id']);
        $alternativeId = $request->only('alternatif_id')['alternatif_id'];
        $alternative = Alternatif::find($alternativeId);

        DB::beginTransaction();
        foreach ($data as $key => $value) {
            DB::table('penilaians')
                ->where('id', '=', $key)
                ->update(['nilai' => $value]);
        }
        DB::commit();

        return redirect()->route('penilaian.index')->with('toast_success', 'Penilaian alternatif ' . $alternative->nama . ' diperbarui!');
    }

    public function calculate()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        // Normalisasi bobot
        $totalBobot = $kriterias->sum('type');
        foreach ($kriterias as $kriteria) {
            $kriteria->bobot_normalized = $kriteria->bobot / $totalBobot;
        }

        // Matrix Penilaian
        $matrixPenilaian = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                $matrixPenilaian[$alternatif->id][$kriteria->id] = $penilaian ? $penilaian->nilai : 0;
            }
        }

        // Normalisasi Matriks
        $matrixNormalisasi = [];
        foreach ($kriterias as $kriteria) {
            $nilaiMax = $penilaians->where('kriteria_id', $kriteria->id)->max('nilai');
            $nilaiMin = $penilaians->where('kriteria_id', $kriteria->id)->min('nilai');

            foreach ($alternatifs as $alternatif) {
                if ($kriteria->type == 'Benefit') {
                    $matrixNormalisasi[$alternatif->id][$kriteria->id] = $matrixPenilaian[$alternatif->id][$kriteria->id] / $nilaiMax;
                } else {
                    $matrixNormalisasi[$alternatif->id][$kriteria->id] = $nilaiMin / $matrixPenilaian[$alternatif->id][$kriteria->id];
                }
            }
        }

        // Nilai Preferensi
        $nilaiPreferensi = [];
        foreach ($alternatifs as $alternatif) {
            $nilaiPreferensi[$alternatif->id] = 0;
            foreach ($kriterias as $kriteria) {
                $nilaiPreferensi[$alternatif->id] += $matrixNormalisasi[$alternatif->id][$kriteria->id] * $kriteria->bobot_normalized;
            }
        }

        // Perankingan
        arsort($nilaiPreferensi);

        return view('penilaian.calculate', compact('alternatifs', 'kriterias', 'matrixPenilaian', 'matrixNormalisasi', 'nilaiPreferensi'));
    }
}
