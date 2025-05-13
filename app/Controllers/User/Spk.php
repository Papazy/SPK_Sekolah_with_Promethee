<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\KriteriaPaudModel;
use App\Models\PaudModel;

class Spk extends BaseController
{
  public function form()
  {
      $model = new KriteriaModel();
      $data['kriteria'] = $model->findAll(); // ambil semua kriteria

      return view('user/spk_form', $data);
  }

  public function hitung()
  {
      // Ambil bobot dari form yang dikirim oleh user
    $bobot = $this->request->getPost('bobot');
    
    $kriteriaModel = new KriteriaModel();
    $kriteria = $kriteriaModel->findAll();
    $kriteriaData = $kriteriaModel->findAll();
    
    // Ambil data PAUD dan nilai kriteria
    $paudModel = new PaudModel();
    $paudData = $paudModel->findAll();
    
    // Mengambil data kriteria
    $kriteriaModel = new KriteriaModel();
    $kriteriaData = $kriteriaModel->findAll();

    // Menghitung preferensi untuk masing-masing PAUD
    $hasil = [];
    foreach ($paudData as $paud) {
        $totalPositiveFlow = 0;
        $totalNegativeFlow = 0;

        foreach ($paudData as $otherPaud) {
            if ($paud['id'] != $otherPaud['id']) {
                // Menghitung perbandingan antara dua PAUD berdasarkan kriteria
                $preferensi = $this->hitungPreferensi($paud, $otherPaud, $bobot, $kriteriaData);
                $totalPositiveFlow += $preferensi['positive'];
                $totalNegativeFlow += $preferensi['negative'];
            }
        }

        // Menghitung total flow
        $totalFlow = $totalPositiveFlow - $totalNegativeFlow;
        $hasil[] = ['nama' => $paud['nama'], 'skor' => $totalFlow];
    }

    // Urutkan hasil berdasarkan skor tertinggi
    usort($hasil, function ($a, $b) {
        return $b['skor'] <=> $a['skor'];
    });
    // Contoh normalisasi sederhana
        $skor = array_column($hasil, 'skor');
        $min = min($skor);
        $max = max($skor);
        $rentang = $max - $min ?: 1; // Hindari pembagian nol

        foreach ($hasil as &$item) {
            $item['skor_normal'] = ($item['skor'] - $min) / $rentang;
        }
        unset($item);

        // Gabungkan kriteria dengan bobot yang dipilih
foreach ($kriteriaData as &$k) {
    $k['bobot'] = (int)($bobot[$k['id']] ?? 0);
}
unset($k);

// Urutkan dari bobot tertinggi ke terendah
usort($kriteriaData, function($a, $b) {
    return $b['bobot'] <=> $a['bobot'];
});

    return view('user/spk_hasil', ['hasil' => $hasil,
        'kriteria' => $kriteriaData,
        'bobot' => $bobot]);
  }

  private function hitungPreferensi($paud1, $paud2, $bobot, $kriteriaData)
{
    $positive = 0;
    $negative = 0;

    foreach ($kriteriaData as $kriteria) {
        $nilai1 = $this->getNilaiPAUD($paud1['id'], $kriteria['id']);
        $nilai2 = $this->getNilaiPAUD($paud2['id'], $kriteria['id']);
        $bobotKriteria = $bobot[$kriteria['id']];

        // Sesuaikan preferensi berdasarkan jenis kriteria (misalnya, lebih besar lebih baik atau lebih kecil lebih baik)
        if ($kriteria['jenis'] == 'Benefit') {
            if ($nilai1 > $nilai2) {
                $positive += $bobotKriteria;
            } else {
                $negative += $bobotKriteria;
            }
        } else {
            if ($nilai1 < $nilai2) {
                $positive += $bobotKriteria;
            } else {
                $negative += $bobotKriteria;
            }
        }
    }

    return ['positive' => $positive, 'negative' => $negative];
}

private function getNilaiPAUD($paudId, $kriteriaId)
{
    $nilaiModel = new KriteriaPaudModel();
    return $nilaiModel->where('paud_id', $paudId)->where('kriteria_id', $kriteriaId)->first()['nilai'];
}
}