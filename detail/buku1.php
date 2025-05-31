<?php
session_start();
include '../connetdb.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . addslashes($_SESSION['success_message']) . "');</script>";
    unset($_SESSION['success_message']);
}

if (!isset($_GET['id'])) {
    echo "ID peminjaman tidak tersedia.";
    exit;
}

$id_peminjaman = $_GET['id'];

// Ambil data buku berdasarkan peminjaman berdasarkan NamaPengguna
$query = mysqli_query($koneksi, "SELECT b.namabuku, b.penciptabuku, b.fotobuku, b.tahunterbit, b.penerbit, b.halaman 
                                 FROM buku b
                                 WHERE b.id_peminjaman = '$id_peminjaman' AND b.NamaPengguna = '{$_SESSION['username']}'");

if (!$query || mysqli_num_rows($query) === 0) {
    echo "Data tidak ditemukan.";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Buku - <?= htmlspecialchars($data['namabuku']) ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">
    <style>
        body {
            background-color: #fff;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            color: #000;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #162589;
            color: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            min-height: 130vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info {
            flex: 1;
            padding-right: 20px;
        }

        .info h1 {
            font-size: 26px;
            font-weight: bold;
        }

        .info p {
            font-weight: 600;
            margin: 6px 0;
        }

        .header img {
            height: 160px;
            border-radius: 10px;
        }

        .pdf-viewer {
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 95vh;
            overflow-y: scroll;
            padding: 10px;
            margin-top: 20px;
            background-color: #fff;
        }

        canvas {
            display: block;
            margin: 0 auto 20px;
            max-width: 100%;
        }

        .review-section {
            margin-top: 20px;
            text-align: right;
        }

        .review-button {
            background-color: rgb(0, 34, 255);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .review-button:hover {
            background-color: rgb(0, 42, 0);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="info">
                <h1><?= htmlspecialchars($data['namabuku']) ?></h1>
                <p><strong>Tahun Terbit:</strong> <?= htmlspecialchars($data['tahunterbit']) ?></p>
                <p><strong>Penerbit:</strong> <?= htmlspecialchars($data['penerbit']) ?></p>
                <p><strong>Halaman:</strong> <?= htmlspecialchars($data['halaman']) ?></p>
            </div>
            <img src="../img/<?= htmlspecialchars($data['fotobuku']) ?>" alt="Sampul Buku" />
        </div>

        <div class="pdf-viewer" id="pdf-container"></div>

        <div class="review-section">
            <button class="review-button" onclick="openModal()">Berikan Ulasan</button>
        </div>
    </div>

    <!-- MODAL ULASAN -->
    <div id="reviewModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background-color:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">

        <div style="background:#fff; border-radius:20px; padding:25px; width:360px; position:relative; text-align:left;">

            <!-- Gambar Cover Buku -->
            <div style="text-align:center;">
                <img src="../img/<?= htmlspecialchars($data['fotobuku']) ?>" alt="<?= htmlspecialchars($data['namabuku']) ?>"
                    style="width:120px; height:auto; border-radius:15px; margin-bottom:15px;">
            </div>

            <!-- Info Buku -->
            <div style="margin-bottom:20px;">
                <h3 style="margin:0 0 10px 0; font-weight:bold;"><?= htmlspecialchars($data['namabuku']) ?></h3>
                <p style="margin:0;">Tahun Terbit : <?= htmlspecialchars($data['tahunterbit']) ?></p>
                <p style="margin:0;">Penerbit : <?= htmlspecialchars($data['penerbit']) ?></p>
                <p style="margin:0;">Halaman : <?= htmlspecialchars($data['halaman']) ?> lembar</p>
            </div>

            <!-- Form Ulasan -->
            <form action="simpan_ulasan.php" method="post">
                <input type="hidden" name="id_peminjaman" value="<?= $id_peminjaman ?>">

                <p style="margin:10px 0 5px;">Ketuk untuk menilai</p>
                <div style="font-size:22px; margin-bottom:10px;">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <label>
                            <input type="radio" name="rating" value="<?= $i ?>" style="display:none;" required>
                            <span class="star" style="cursor:pointer;">★</span>
                        </label>
                    <?php endfor; ?>
                </div>

                <textarea name="ulasan" placeholder="Masukkan ulasan anda" required
                    style="width:100%; min-height:70px; margin-top:10px; padding:10px; border-radius:10px; border:1px solid #ccc; resize:none;"></textarea>

                <div style="display:flex; justify-content:space-between; margin-top:20px;">
                    <button type="button" onclick="closeModal()"
                        style="background:#001fbd; color:#fff; padding:10px 20px; border:none; border-radius:10px; font-weight:bold;">Batal</button>
                    <button type="submit"
                        style="background:#001fbd; color:#fff; padding:10px 20px; border:none; border-radius:10px; font-weight:bold;">Kirim</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function openModal() {
            document.getElementById('reviewModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('reviewModal').style.display = 'none';
        }

        const stars = document.querySelectorAll('.star');
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                document.querySelectorAll('.star').forEach((s, i) => {
                    s.style.color = i <= index ? '#ffcc00' : '#000';
                });
                star.previousElementSibling.checked = true;
            });
        });
    </script>

    <!-- PDF.js library -->
    <script src="pdfjs/pdf.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'pdfjs/pdf.worker.js';
        const url = 'buku/Frequency-and-Music.pdf';
        const container = document.getElementById('pdf-container');

        const renderPDF = async (url) => {
            const pdf = await pdfjsLib.getDocument(url).promise;

            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                const page = await pdf.getPage(pageNum);
                const canvas = document.createElement("canvas");
                const context = canvas.getContext("2d");
                const viewport = page.getViewport({
                    scale: 1.5
                });

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                await page.render({
                    canvasContext: context,
                    viewport
                }).promise;
                container.appendChild(canvas);
            }
        };

        renderPDF(url);
    </script>
</body>

</html>