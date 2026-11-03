<?php
// 1. VARIABEL & TIPE DATA
$namaMahasiswa = "Andi Susanto";
$semester = 5; // Integer
$statusAktif = true; // Boolean
$nilaiTugas = [85, 90, 78, 88]; // Array

// 2. FUNGSI
function hitungRataRata($kumpulanNilai) {
    $total = 0;
    foreach ($kumpulanNilai as $nilai) {
        $total = $total + $nilai;
    }
    return $total / count($kumpulanNilai);
}

$rataRataAkhir = hitungRataRata($nilaiTugas);

// 3. LOGIKA PENGKONDISIAN (IF-ELSE)
$gradeHuruf = "";
if ($rataRataAkhir >= 85) {
    $gradeHuruf = "A";
} elseif ($rataRataAkhir >= 70) {
    $gradeHuruf = "B";
} elseif ($rataRataAkhir >= 60) {
    $gradeHuruf = "C";
} else {
    $gradeHuruf = "D";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Fundamental PHP</title>
</head>
<body>
    <?php
    // 4. OUTPUT & MENGGABUNGKAN PHP DENGAN HTML
    echo "<h2>Profil Akademik Mahasiswa</h2>";
    echo "Nama : " . $namaMahasiswa . "<br>";
    echo "Semester : " . $semester . "<br>";
    echo "Status: " . ($statusAktif ? "Aktif" : "Cuti") . "<br><br>";

    // 5. PERULANGAN (FOREACH)
    echo "<b>Rincian Nilai Tugas:</b><br>";
    foreach ($nilaiTugas as $indeks => $nilai) {
        $urutanTugas = $indeks + 1;
        echo "- Tugas ke-$urutanTugas: $nilai<br>";
    }

    echo "<br><b>Nilai Rata-rata: " . $rataRataAkhir . "</b><br>";
    echo "<b>Grade: " . $gradeHuruf . "</b><br><br>";

    // 6. SWITCH - CASE
    echo "Pesan dari Dosen: ";
    switch ($gradeHuruf) {
        case "A":
            echo "Luar biasa! Pertahankan prestasimu.";
            break;
        case "B":
            echo "Bagus, tapi masih bisa ditingkatkan lagi.";
            break;
        case "C":
            echo "Cukup. Ayo belajar lebih giat lagi di semester depan.";
            break;
        default:
            echo "Anda harus mengulang mata kuliah ini.";
            break;
    }
    ?>
</body>
</html>