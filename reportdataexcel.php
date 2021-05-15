<?php
	//membuka koneksi ke database
	include "koneksi.php";
	//memanggil library
	require 'vendor/autoload.php';
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	// menampilkan kolom
	$spreadsheet=new spreadsheet();
	$sheet=$spreadsheet->getActiveSheet();
	$sheet->setCellValue('A1','no');
	$sheet->setCellValue('B1','nama');
	$sheet->setCellValue('C1','kelas');
	$sheet->setCellValue('D1','alamat');

	//mengambil data pada database
	$query=mysqli_query($conn,"select * from tb_siswa");
	$i=2;
	$no=1;
	while($row=mysqli_fetch_array($query)){
		$sheet->setCellValue('A'.$i,$no++);
		$sheet->setCellValue('B'.$i,$row['nama']);
		$sheet->setCellValue('C'.$i,$row['kelas']);
		$sheet->setCellValue('D'.$i,$row['alamat']);
		$i++;
	}


	$styleArray=[
				'borders'=>[
					'allBorders'=>[
						'borderStyle'=>PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					],
				],
	];

	$i=$i-1;
	$sheet->getStyle('A1:D'.$i)->applyFromArray($styleArray);
	$writer=new Xlsx($spreadsheet);
	$writer->save('Report Data Siswa.xlsx');
  //menampilkan file excel
?>
