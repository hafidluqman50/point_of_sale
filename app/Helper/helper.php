<?php 

function format_rupiah($rupiah) {
	$hasil_rupiah = 'Rp. ' . number_format($rupiah,2,',','.');
	return $hasil_rupiah;
}

function session_expired() {
	if (session()->has('data_session')) {
		$data_session = session()->get('data_session');
		if (array_key_exists('time_expired',$data_session)) {
			if ($data_session['time_expired'] != '' && time() > $data_session['time_expired']) {
				session()->forget('data_session');
			}
		}
	}
}

function generate_time($time) {
	// using second
	$generate = time() + ($time);

	return $generate;
}

function unslug_str($str) {
	$get = explode('-',$str);
	return ucwords($get[0]).' '.ucwords($get[1]);
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