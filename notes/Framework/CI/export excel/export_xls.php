<?php require_once('../Connections/cn_dbpas.php'); ?>
<?php
include('../pas_librari/pas_lib.php');

//Memanggil 4 file librari untuk generate ms excel dari php
require_once('../pas_librari/OLEwriter.php');
require_once('../pas_librari/BIFFwriter.php');
require_once('../pas_librari/Worksheet.php');
require_once('../pas_librari/Workbook.php');

function HeaderingExcel($filename){
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=$filename");
header("Expires:0");
header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
header("Pragma: public");
}

$bulan = date('m');
$tahun_ini = date('Y');
if ($bulan > 6 ) { $tahun_ajaran = $tahun_ini - 1994; } else { $tahun_ajaran = $tahun_ini - 1995; } 
$tahun_ajaran++;

//Query data yang akan di export ke Excel
mysql_select_db($database_cn_dbpas, $cn_dbpas);
$query_rs_calsis = "SELECT * FROM t_calon_siswa WHERE KD_TAHUN_AJARAN = '$tahun_ajaran' ORDER BY NO_CALSIS DESC";
$rs_calsis = mysql_query($query_rs_calsis, $cn_dbpas) or die(mysql_error());
$row_rs_calsis = mysql_fetch_assoc($rs_calsis);
$totalRows_rs_calsis = mysql_num_rows($rs_calsis);
$total = $totalRows_rs_calsis;

//http headers
HeaderingExcel('CalonSiswa.xls');
//membuat workbook
$workbook=new Workbook("-");
$worksheet1= & $workbook->add_worksheet("Calon Siswa");

$judul=& $workbook->add_format(); //Memformat header (judul) tabel dengan font bold, horiz rata tengah dan verical rata tengah
$judul->set_bold(); 
$judul->set_align('center');
$judul->set_align('vcenter');

$jdl=& $workbook->add_format();  //Memformat Judul dengan font tebal, wanrna biru, hiriz rata kiri, verti rata tengah dan ukuran font 12
$jdl->set_bold(); 
$jdl->set_color('blue');
$jdl->set_align('left');
$jdl->set_align('vcenter');
$jdl->set_size(12); 

$tengah=& $workbook->add_format();
$tengah->set_align('center');

$kanan=& $workbook->add_format();
$kanan->set_align('right');

$worksheet1->set_row(0,30);	      //set tinggi baris judul
$worksheet1->set_row(1,20);       //set tinggi baris header tabel
$worksheet1->set_column(1,0,5);   //set lebar colom no
$worksheet1->set_column(1,1,11);  //set lebar colom no calsis
$worksheet1->set_column(1,2,25);  //set lebar colom nm siswa
$worksheet1->set_column(1,3,15);  //set lebar colom kota lahir
$worksheet1->set_column(1,4,15);  //set lebar colom tgl lahir
$worksheet1->set_column(1,5,13);  //set lebar colom gol darah
$worksheet1->set_column(1,6,11);  //set lebar colom agama
$worksheet1->set_column(1,7,40);  //set lebar colom alamat
$worksheet1->set_column(1,8,15);  //set lebar colom telpon
$worksheet1->set_column(1,9,40);  //set lebar colom asal smp
$worksheet1->set_column(1,10,11);  //set lebar colom bayar
$worksheet1->set_column(1,11,15);  //set lebar colom tgl seleksi
$title = "DATA CALON SISWA TAHUN AJARAN ".kd_tahunajaran($tahun_ajaran);
$worksheet1->write_string(0,0,$title,$jdl);  //tulis judul pada worksheet1 barir 0, kolom 0
$worksheet1->write_string(1,0,"NO",$judul);  //tulis NO pada worksheet1 barir 1, kolom 0
$worksheet1->write_string(1,1,"NO CALSIS",$judul);  //tulis NO CALSIS pada worksheet1 barir 1, kolom 1
$worksheet1->write_string(1,2,"NAMA SISWA",$judul); //tulis NAMA SISWA pada worksheet1 barir 1, kolom 2
$worksheet1->write_string(1,3,"KOTA LAHIR",$judul);
$worksheet1->write_string(1,4,"TANGGAL LAHIR",$judul);
$worksheet1->write_string(1,5,"GOL DARAH",$judul);
$worksheet1->write_string(1,6,"AGAMA",$judul);
$worksheet1->write_string(1,7,"ALAMAT",$judul);
$worksheet1->write_string(1,8,"TELPON",$judul);
$worksheet1->write_string(1,9,"ASAL SMP",$judul);
$i = 1;
do { 
   $i++;
   $no++;
   $worksheet1->write_string($i,0,$no,$kanan);
   $worksheet1->write_string($i,1,$row_rs_calsis['NO_CALSIS'],$tengah);
   $worksheet1->write_string($i,2,$row_rs_calsis['NM_SISWA']);
   $worksheet1->write_string($i,3,$row_rs_calsis['KOTA_LAHIR']);
   $tgl_lahir = tgltoindo($row_rs_calsis['TANGGAL_LAHIR']);
   $worksheet1->write_string($i,4,$tgl_lahir,$tengah);
   $gol_darah = kd_gol_darah($row_rs_calsis['KD_GOL_DARAH']);
   $worksheet1->write_string($i,5,$gol_darah);
   $agama = kd_agama($row_rs_calsis['KD_AGAMA']);
   $worksheet1->write_string($i,6,$agama);
   $worksheet1->write_string($i,7,$row_rs_calsis['ALAMAT']);
   $worksheet1->write_string($i,8,$row_rs_calsis['NO_TELP']);
   $asal_smp = kd_asal_sekolah($row_rs_calsis['ASAL_SMP']);
   $worksheet1->write_string($i,9,$asal_smp);
} while ($row_rs_calsis = mysql_fetch_assoc($rs_calsis));
$workbook->close();
mysql_free_result($rs_calsis);
?>
