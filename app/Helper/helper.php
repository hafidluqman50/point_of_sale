<?php 

function format_rupiah($rupiah) {
	$hasil_rupiah = 'Rp. ' . number_format($rupiah,2,',','.');
	return $hasil_rupiah;
}

function remove_file($dir,$file) {
	if (file_exists(public_path($dir.$file))) {
		unlink(public_path($dir.$file));
	}
}

function replace_file($file_old,$dir,$file_new,$tmp) {
	if (file_exists(public_path($dir.$file_old))) 
	{
		unlink(public_path($dir.$file_old));
		$tmp->move(public_path($dir),$file_new);
	}
	else {
		$tmp->move(public_path($dir),$file_new);
	}
}

function human_date($date) {
	$explode = explode('-',$date);
	return $explode[2].' '.month($explode[1]).' '.$explode[0];
}

function month($month) {
	$array = [
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	];
	return $array[$month];
}