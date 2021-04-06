<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
	<title>Struk Transaksi</title>
	<style>
		@page {
			margin:0!important;
			size:5cm 7cm;
			size:portrait;
  			-webkit-print-color-adjust: exact !important;
		}
		body {
			background-color:grey;
		}
		.struk {
			width:100%;
			min-height:500px;
			background:white;
			padding-left:1%;
			padding-right:1%;
			position:relative;
  			box-shadow: 5px 10px #888888;
		}
		.layout-struk {
			width:100%;
			min-height:100%;
			position:absolute;
			top:0;
			background-color: lightgrey;
		}
		.struk-header {
			width:100%;
			min-height:105px;
			border-bottom:1px solid lightgrey;
			text-align: center;
		}
		.struk-info {
			width:100%;
			height:90px;
			margin-top:5px;
			margin-bottom:5px;
			border-bottom:1px solid lightgrey;
		}
		.struk-menu {
			width:100%;
			min-height:100px;
			margin-bottom:10px;
		}
		.struk-total {
			width:100%;
			height:100px;
			border-top:1px solid lightgrey;
			border-bottom:1px solid lightgrey;
			margin:0;
		}
		.struk-catatan {
			width:100%;
			height:50px;
			border-top: 1px solid lightgrey;
			padding-top:10px;
		}
	</style>
</head>
<body>
	<div class="layout-struk">
		<div class="container-fluid">
			<div class="struk">
				<div class="struk-header">
					{{-- <div class="row align-items-center justify-content-center"> --}}
						<h5 style="margin-bottom:7px;"><b>JupiterPOS</b></h5>
						<p style="margin:0;">{{ $info_outlet->nama_outlet }}</p>
						<p style="margin:0;">{{ $info_outlet->alamat_outlet }}</p>
						<p><span class="fas fa-phone"></span> {{ $info_outlet->nomor_telepon }}</p>
					{{-- </div> --}}
				</div>
				<div class="struk-info">
					@php
						$jam = explode(' ',$transaksi_info->created_at)
					@endphp
					<p>{{ human_date($transaksi_info->tanggal_transaksi).' '.$jam[1] }}</p>
					<p>Kasir : {{ $transaksi_info->name }}</p>
				</div>
				<div class="struk-menu">
					<table width="100%">
						@foreach ($get_transaksi as $element)
						@php
							$explode = explode(':',$element->varian);
						@endphp
						<tr>
							<td><b>{{ $element->nama_item }}</b>
								<td><b><span style="float:right">{{ format_rupiah($element->sub_total) }}</span></b></td>
								@if ($element->varian != null)
								<tr>
									<td>-----{{$explode[0]}} : </td>
									<td><span style="float:right">{{ format_rupiah($explode[1]) }}</span></td>
								</tr>
								@endif
								@if ($element->keterangan != null)
								<tr>
									<td>-----{{$element->keterangan}}</td>
								</tr>
								@endif
							</td>
						</tr>
						@endforeach
					</table>
				</div>
				<div class="struk-total">
					<table width="100%">
						<tr>
							<td><b>-----------Total Harga------------ : </b></td>
							<td><span style="float:right;"><b>{{ format_rupiah($transaksi_info->total_harga) }}</b></span></td>
						</tr>
						<tr>
							<td><b>-----------Total Bayar------------ : </b></td>
							<td><span style="float:right;"><b>{{ format_rupiah($transaksi_info->total_bayar) }}</b></span></td>
						</tr>
						<tr>
							<td><b>-----------Kembalian------------- :</b></td>
							<td><span style="float:right;"><b>{{ format_rupiah($transaksi_info->kembalian) }}</b></span></td>
						</tr>
					</table>
				</div>
				<div class="struk-catatan">
					<p>{{ $info_outlet->catatan }}</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script>
	window.print();
</script>