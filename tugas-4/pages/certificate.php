<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

// Tambahkan baris ini untuk mengambil user_id dari session
$user_id = $_SESSION['user_id']; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat_<?php echo $_SESSION['nama']; ?></title>
    <style>
        /* Mengunci ukuran kertas dan menghilangkan margin browser */
        @page { 
            size: landscape; 
            margin: 0; 
        }
        
        body { 
            margin: 0; 
            padding: 0; 
            background-color: #f5f5f5; 
            -webkit-print-color-adjust: exact; /* Memastikan warna muncul saat print */
        }

        .certificate-container {
            width: 297mm; 
            height: 210mm; 
            padding: 10mm; /* Ruang aman agar tidak terpotong printer */
            margin: auto;
            box-sizing: border-box;
            background: white;
        }

        .border-outer {
            border: 10px solid #0056b3;
            height: 100%;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .border-inner {
            border: 2px solid #e2a03f;
            width: calc(100% - 20px);
            height: calc(100% - 20px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        h1 { font-size: 50pt; color: #0056b3; margin: 10px 0; font-family: 'Georgia', serif; }
        .sub-title { font-size: 18pt; letter-spacing: 4px; color: #555; text-transform: uppercase; }
        .name { font-size: 40pt; font-weight: bold; color: #333; margin: 15px 0; font-style: italic; border-bottom: 2px solid #333; display: inline-block; padding: 0 40px; }
        .content { font-size: 16pt; color: #444; max-width: 80% }
        
        .footer { width: 80%; margin-top: 30px; display: flex; justify-content: space-between; align-items: flex-end; }
        .sig-box { text-align: center; width: 200px; }
        .signature { border-top: 1px solid #333; margin-top: 50px; font-weight: bold; }

        @media print {
            .no-print { display: none; }
            body { background: none; }
            .certificate-container { margin: 0; border: none; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="background: #333; color: white; padding: 10px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; font-weight: bold; cursor: pointer;">Cetak Sertifikat (Landscape)</button>
        <p style="margin: 5px 0; font-size: 12px;">Tips: Jika masih terpotong, set <b>Margin</b> ke <b>None</b> di pengaturan Print browser.</p>
    </div>

    <div class="certificate-container">
        <div class="border-outer">
            <div class="border-inner">
                <p class="sub-title">Sertifikat Penghargaan</p>
                <h1>KELULUSAN KURSUS</h1>
                <p class="content">Diberikan kepada:</p>
                
                <div class="name"><?php echo $_SESSION['nama']; ?></div>
                
                <p class="content">
                    Telah menyelesaikan seluruh kurikulum dan praktik pada kursus:<br>
                    <strong>Web Programming Mastery (Versi 5.0)</strong>
                </p>

                <div class="footer">
                    <div class="sig-box">
                        <p>ID: WLA-<?php echo date('Y').$user_id; ?></p>
                    </div>
                    <div class="sig-box">
                        <div class="signature">Instruktur Utama</div>
                        <p>Gemini AI Lab</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>