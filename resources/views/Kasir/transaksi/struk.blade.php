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
			/*size:50mm 70mm;*/
			/*size:portrait;*/
  			-webkit-print-color-adjust:exact!important;
		}
		.struk {
			width:100%;
			min-height:500px;
			background:white;
			padding-left:1%;
			padding-right:1%;
			position:relative;
			border:1px solid black;
			box-shadow: -1px 0px 8px 2px rgba(196,196,196,0.89);
			-webkit-box-shadow: -1px 0px 8px 2px rgba(196,196,196,0.89);
			-moz-box-shadow: -1px 0px 8px 2px rgba(196,196,196,0.89);
		}
		.layout-struk {
			width:57mm;
			margin:0 auto;
			/*position:absolute;*/
			/*top:0;*/
			/*left:40%;*/
		}
		.struk-header {
			width:100%;
			min-height:105px;
			border-bottom:1px solid lightgrey;
			text-align: center;
		}
		.struk-info {
			width:100%;
			height:60px;
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
			min-height:100px;
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
						<h5 style="margin-bottom:7px; font-size:17px;"><b>JupiterPOS</b></h5>
						<p style="margin:0; font-size:15px;">{{ $info_outlet->nama_outlet }}</p>
						<p style="margin:0; font-size:15px;">{{ $info_outlet->alamat_outlet }}</p>
						<p style="font-size:15px;"><span class="fas fa-phone"></span> {{ $info_outlet->nomor_telepon }}</p>
					{{-- </div> --}}
				</div>
				<div class="struk-info">
					@php
						$jam = explode(' ',$transaksi_info->created_at)
					@endphp
					<p style="font-size:13px;">{{ human_date($transaksi_info->tanggal_transaksi).' '.$jam[1] }}</p>
					<p style="font-size:13px;">Kasir : {{ $transaksi_info->name }}</p>
				</div>
				<div class="struk-menu">
					<table width="100%">
						@foreach ($get_transaksi as $element)
						@php
							$explode = explode(':',$element->varian);
						@endphp
						<tr>
							<td style="font-size:13px;"><b>{{ $element->nama_item }} : </b>
								<td style="font-size:13px;"><b><span style="float:right">{{ format_rupiah($element->sub_total) }}</span></b></td>
								@if ($element->varian != null)
								<tr>
									<td style="font-size:13px;">&nbsp;&nbsp;{{$explode[0]}} : </td>
									<td><span style="float:right">{{ format_rupiah($explode[1]) }}</span></td>
								</tr>
								@endif
								@if ($element->keterangan != null)
								<tr>
									<td style="font-size:13px;">&nbsp;&nbsp;{{$element->keterangan}}</td>
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
							<td style="font-size:13px;"><b>Total Harga : </b></td>
							<td style="font-size:13px;"><span style="float:right;"><b>{{ format_rupiah($transaksi_info->total_harga) }}</b></span></td>
						</tr>
						<tr>
							<td style="font-size:13px;"><b>Total Bayar : </b></td>
							<td style="font-size:13px;"><span style="float:right;"><b>{{ format_rupiah($transaksi_info->total_bayar) }}</b></span></td>
						</tr>
						<tr>
							<td style="font-size:13px;"><b>Kembalian :</b></td>
							<td style="font-size:13px;"><span style="float:right;"><b>{{ format_rupiah($transaksi_info->kembalian) }}</b></span></td>
						</tr>
					</table>
				</div>
				<div class="struk-catatan">
					<p style="font-size:13px;">{{ $info_outlet->catatan }}</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script>
	window.print();
</script>