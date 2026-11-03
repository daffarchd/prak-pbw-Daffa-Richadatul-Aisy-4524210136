<?php
// biodata_modifikasi.php - Modifikasi Tugas 1 Prak PBW (Versi Dipercantik)
// Nama: Daffa Richadatul'Aisy
// NPM : 4524210136

$mahasiswa = [
    'NPM' => '4524210136',
    'Nama Lengkap' => "Daffa Richadatul'Aisy",
    'Program Studi' => 'Teknik Informatika',
    'Mata Kuliah' => 'Praktikum Pemrograman Berbasis Web',
    'Status' => 'Aktif (Semester 5)'
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Biodata Mahasiswa - Daffa</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card { 
            background: #ffffff; 
            width: 100%;
            max-width: 480px;
            padding: 35px; 
            border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .profile-header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #f0f2f5;
            padding-bottom: 20px;
        }
        .avatar {
            width: 75px;
            height: 75px;
            background: linear-gradient(135deg, #1a73e8, #4285f4);
            color: white;
            font-size: 28px;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            margin: 0 auto 12px auto;
            box-shadow: 0 4px 10px rgba(26, 115, 232, 0.3);
        }
        h1 { 
            color: #202124; 
            font-size: 22px; 
            font-weight: 600;
        }
        .badge-tugas {
            display: inline-block;
            background: #e8f0fe;
            color: #1a73e8;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            margin-top: 6px;
        }
        ul { 
            list-style-type: none; 
        }
        li { 
            display: flex;
            justify-content: space-between;
            padding: 12px 0; 
            border-bottom: 1px solid #f1f3f4; 
            font-size: 14px;
        }
        li:last-child {
            border-bottom: none;
        }
        .label {
            color: #5f6368;
            font-weight: 600;
        }
        .value {
            color: #202124;
            font-weight: 500;
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: #80868b;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="profile-header">
        <div class="avatar">DR</div>
        <h1>Profil Mahasiswa</h1>
        <span class="badge-tugas">Tugas 1 - Prak PBW</span>
    </div>

    <ul>
        <?php foreach ($mahasiswa as $kunci => $nilai): ?>
            <li>
                <span class="label"><?= htmlspecialchars($kunci) ?></span>
                <span class="value"><?= htmlspecialchars($nilai) ?></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="footer">
        &copy; 2026 &bull; Daffa Richadatul'Aisy
    </div>
</div>

</body>
</html>