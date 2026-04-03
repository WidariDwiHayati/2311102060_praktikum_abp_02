<?php
$mahasiswa = [
    [
        "nama" => "Widari Dwi Hayati",
        "nim" => "2311102060",
        "tugas" => 85,
        "uts" => 80,
        "uas" => 90
    ],
    [
        "nama" => "Budi Raharjo",
        "nim" => "231102061",
        "tugas" => 60,
        "uts" => 55,
        "uas" => 65
    ],
    [
        "nama" => "Citra Lestari",
        "nim" => "231102062",
        "tugas" => 95,
        "uts" => 90,
        "uas" => 85
    ],
    [
        "nama" => "Dewi Sartika",
        "nim" => "231102063",
        "tugas" => 45,
        "uts" => 50,
        "uas" => 40
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilai) {
    if ($nilai >= 80) {
        return "A";
    } elseif ($nilai >= 70) {
        return "B";
    } elseif ($nilai >= 60) {
        return "C";
    } elseif ($nilai >= 50) {
        return "D";
    } else {
        return "E";
    }
}

function tentukanStatus($nilai) {
    if ($nilai >= 60) { 
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

$totalNilaiKelas = 0;
$nilaiTertinggi = 0;
$jumlahMahasiswa = count($mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        .lulus { color: green; font-weight: bold; }
        .gagal { color: red; font-weight: bold; }
        .statistik { background-color: #f9f9f9; padding: 15px; border: 1px solid #ddd; }
    </style>
</head>
<body>

    <h2>Daftar Nilai Akhir Mahasiswa</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nilai Akhir</th>
            <th>Grade</th>
            <th>Status</th>
        </tr>

        <?php
        $no = 1;
        foreach ($mahasiswa as $mhs) {
            $nilaiAkhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
            $grade = tentukanGrade($nilaiAkhir);
            $status = tentukanStatus($nilaiAkhir);

            $totalNilaiKelas += $nilaiAkhir;
            
            if ($nilaiAkhir > $nilaiTertinggi) {
                $nilaiTertinggi = $nilaiAkhir;
            }

            $classStatus = ($status == "Lulus") ? "lulus" : "gagal";

            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td style='text-align:left;'>" . $mhs['nama'] . "</td>";
            echo "<td>" . $mhs['nim'] . "</td>";
            echo "<td>" . number_format($nilaiAkhir, 2) . "</td>";
            echo "<td>" . $grade . "</td>";
            echo "<td class='$classStatus'>" . $status . "</td>";
            echo "</tr>";
        }

        $rataRataKelas = $totalNilaiKelas / $jumlahMahasiswa;
        ?>

    </table>

    <div class="statistik">
        <h3>Statistik Kelas:</h3>
        <ul>
            <li><strong>Rata-rata Kelas:</strong> <?php echo number_format($rataRataKelas, 2); ?></li>
            <li><strong>Nilai Tertinggi:</strong> <?php echo number_format($nilaiTertinggi, 2); ?></li>
        </ul>
    </div>

</body>
</html>