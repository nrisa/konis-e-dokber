<?php
require('fpdf/fpdf.php'); // Path ke fpdf.php

$servername = "localhost";
$username = "root";
$password = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "test_db";

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari tabel tbl_berita dengan status = 0
$query = "SELECT * FROM tbl_berita WHERE status = 0 ORDER BY no_id DESC";
$tampil = mysqli_query($koneksi, $query);

// Lebar halaman landscape
$pdf = new FPDF('L', 'mm', 'A3'); // 'L' untuk Landscape, 'mm' untuk milimeter, 'A4' untuk ukuran halaman
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 10, 'Laporan Masuk', 0, 1, 'C');
$pdf->Ln(10);

// Hitung lebar kolom dinamis
$widths = [
    10,  // No
    40,  // Nomor Agenda
    30,  // Dari
    30,  // Kepada
    30,  // Tembusan
    30,  // Klasifikasi
    30,  // Nomor Dokumen
    20,  // TWU
    70,  // Isi
    30   // Disposisi
];

// Buat header tabel
$pdf->SetFont('Arial', 'B', 6);
$header = [
    'No', 'Nomor Agenda', 'Dari', 'Kepada', 'Tembusan', 
    'Klasifikasi', 'Nomor Dokumen', 'TWU', 'Isi', 'Disposisi'
];
for ($i = 0; $i < count($header); $i++) {
    $pdf->Cell($widths[$i], 10, $header[$i], 1);
}
$pdf->Ln();

$no = 1;
$pdf->SetFont('Arial', '', 6);
while ($data = mysqli_fetch_array($tampil)) {
    $pdf->Cell($widths[0], 10, $no, 1);
    $pdf->Cell($widths[1], 10, $data['nomor_agenda'], 1);
    $pdf->Cell($widths[2], 10, $data['dari'], 1);
    $pdf->Cell($widths[3], 10, $data['kepada'], 1);
    $pdf->Cell($widths[4], 10, $data['tembusan'], 1);
    $pdf->Cell($widths[5], 10, $data['klasifikasi'], 1);
    $pdf->Cell($widths[6], 10, $data['nomor_surat'], 1);
    $pdf->Cell($widths[7], 10, $data['twu'], 1);

    // Bungkus teks 'Isi' jika terlalu panjang
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell($widths[8], 10, $data['isi'], 1);
    $pdf->SetXY($x + $widths[8], $y);

    $pdf->Cell($widths[9], 10, $data['disposisi'], 1);
    $pdf->Ln();
    $no++;
}

$pdf->Output();
$koneksi->close();
?>
