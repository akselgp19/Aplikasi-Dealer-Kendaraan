<?php

include "config/koneksi.php";
include "fungsi.php";
require('fpdf/fpdf.php');

$query = mysqli_query($con,"SELECT * FROM bayar
								WHERE id = '$_GET[id]'")or die(mysqli_error());
$num = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);

if ($num == 0) {
	echo "<script language='javascript'>
				alert('Data penjualan tidak ditemukan atau masih kosong');
				window.location='transaksi.php';
	</script>";
}

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->cell(190,7,'AKSEL DEALER',0,1,'C');

$pdf->SetFont('Arial','B',12);

$pdf->cell(190,7,'Perumahan Nuansa Hijau Block D No. 1, Ciomas, Bogor.',0,1,'C');

$pdf->Line(10,30,200,30);

$pdf->Ln(5);

$pdf->cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);

include 'config/koneksi.php';
$isi = mysqli_query($con, "SELECT * FROM bayar");
while ($row_edit = mysqli_fetch_array($isi)){
	// =============================================
	$pdf->cell(25,5,'id :',0,0);
    $pdf->Cell(25,5,$row_edit['id'],0,1);
    $pdf->cell(25,5,'Nama :',0,0);
    $pdf->Cell(25,5,$row_edit['nama'],0,1);
    $pdf->cell(25,5,'Alamat :',0,0);
    $pdf->Cell(25,5,$row_edit['alamat'],0,1); 
	// =============================================
    $pdf->Line(10,55,200,55);
	$pdf->Ln(10);
	// =============================================
	$pdf->cell(25,5,'Merk :',0,0);
    $pdf->Cell(25,5,$row_edit['merk'],0,0);
    $pdf->cell(25,5,'Tenor :',0,0);
    $pdf->Cell(25,5,$row_edit['tenor'],0,0);
    $pdf->cell(25,5,'DP :',0,0);
    $pdf->Cell(25,5,$row_edit['dp'],0,1);
    // =============================================
    $pdf->cell(25,5,'Tipe :',0,0);
    $pdf->Cell(25,5,$row_edit['tipe'],0,0);
    $pdf->cell(25,5,'Bunga :',0,0);
    $pdf->Cell(25,5,$row_edit['bunga'],0,0);
    $pdf->cell(25,5,'Angsuran :',0,0);
    $pdf->Cell(25,5,$row_edit['angsuran'],0,1);
    // =============================================
    $pdf->cell(25,5,'Harga :',0,0);
    $pdf->Cell(25,5,$row_edit['harga'],0,0);
    $pdf->cell(25,5,'Harga Kredit :',0,0);
    $pdf->Cell(25,5,$row_edit['hargakredit'],0,0);
    $pdf->cell(25,5,'Sisa Cicilan :',0,0);
    $pdf->Cell(25,5,$row_edit['sisa'],0,1);
    // =============================================
    $pdf->Line(10,80,200,80);
	$pdf->Ln(10);
	// =============================================
	$pdf->cell(25,5,'Paid by :',0,0);
    $pdf->Cell(25,5,$row_edit['nama'],0,0);
    // =============================================
    $pdf->Line(155,95,195,95);
	$pdf->Ln(18);
	// =============================================
	$pdf->cell(140,5,'',0,0);
    $pdf->Cell(50,5,'Signature',0,1,'C');
    // =============================================
    $pdf->Cell(0, 6, 'Barang yang dibeli tidak dapat dikembalikan, kecuali ada perjanjian.', 0, 1, 'C', 0);
}

$pdf->Output();

?>