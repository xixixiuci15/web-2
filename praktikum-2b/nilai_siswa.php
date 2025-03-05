<?php 
$proses = $_POST['proses']; 
$nama_siswa = $_POST['nama']; 
$mata_kuliah = $_POST['matkul']; 
$nilai_uts = $_POST['nilai_uts']; 
$nilai_uas = $_POST['nilai_uas']; 
$nilai_tugas = $_POST['nilai_tugas']; 

$nilai_akhir = 0; 
$grade = ''; 
$predikat = ''; 

/* - MENENTUKAN LULUS ATAU TIDAK MENGGUNAKAN IF ELSE - SISWA DINYATAKAN LULUS JIKA NILAI TOTAL dengan presentase 30% UTS, 35% UAS dan TUGAS 35% melebihi 55 */ 
$nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35); 
if ($nilai_akhir > 55) { 
    $status = 'Lulus'; 
} else { 
    $status = 'Tidak Lulus'; 
} 

// MENENTUKAN GRADE NILAI MENGGUNAKAN SYNTAX IF ELSE MULTIKONDISI 
/* - Grade E : Jika Nilai Akhir 0-35 - Grade D : Jika Nilai Akhir 36-55 - Grade C : Jika Nilai Akhir 56-69 - Grade B : Jika Nilai Akhir 70-84 - Grade A : Jika Nilai Akhir 85-100 - Grade I : Jika Nilai Akhir < 0 atau Nilai Akhir > 100 */ 
    if ($nilai_akhir >= 0 && $nilai_akhir <= 35) { 
        $grade = 'E'; 
    } elseif ($nilai_akhir >= 36 && $nilai_akhir <= 55) { 
        $grade = 'D'; 
    } elseif ($nilai_akhir >= 56 && $nilai_akhir <= 69) { 
        $grade = 'C'; 
    } elseif ($nilai_akhir >= 70 && $nilai_akhir <= 84) { 
        $grade = 'B'; 
    } elseif ($nilai_akhir >= 85 && $nilai_akhir <= 100) { 
        $grade = 'A'; 
    } else { 
        $grade = 'I'; 
    } 

// MENENTUKAN PREDIKAT NILAI MENGGUNAKAN SYNTAX SWITCH 
/* - Predikat Sangat Kurang : Jika Grade E - Predikat Kurang : Jika Grade D - Predikat Cukup : Jika Grade C - Predikat Memuaskan : Jika Grade B - Predikat Sangat Memuaskan : Jika Grade A - Predikat Tidak Ada : Jika Grade I */ 
switch ($grade) { 
    case 'E': 
        $predikat = 'Sangat Kurang'; 
        break; 
    case 'D': 
        $predikat = 'Kurang'; 
        break; 
    case 'C': 
        $predikat = 'Cukup'; 
        break; 
    case 'B': 
        $predikat = 'Memuaskan'; 
        break; 
    case 'A': 
        $predikat = 'Sangat Memuaskan'; 
        break; 
    default: 
        $predikat = 'Tidak Ada'; 
        break; 
} 
// Menampilkan Hasil
    {
        echo "<div style='width: 70%; max-width: 700px; margin: 30px auto; padding: 20px; 
    border: 2px solid black; border-radius: 10px; background-color: lightgreen; 
    box-shadow: 5px 5px 10px rgba(0,0,0,0.2);'>";

echo "<h3 style='text-align: center; color: black;'>Hasil Nilai Siswa</h3>";
echo "<table style='width: 100%; border-collapse: collapse;'>"; // Tabel lebar penuh
echo "<tr><td style='padding: 12px; font-weight: bold; width: 30%;'>Nama</td><td>: $nama_siswa</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Mata Kuliah</td><td>: $mata_kuliah</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Nilai UTS</td><td>: $nilai_uts</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Nilai UAS</td><td>: $nilai_uas</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Nilai Tugas</td><td>: $nilai_tugas</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Nilai Akhir</td><td>: " . number_format($nilai_akhir, 2, ',', '.') . "</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Status</td><td>: <span style='color:" . ($status == 'Lulus' ? 'green' : 'red') . "; font-weight: bold;'>$status</span></td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Grade</td><td>: $grade</span></td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Predikat</td><td>: $predikat</td></tr>";
echo "</table>";
echo "</div>";

}
?>