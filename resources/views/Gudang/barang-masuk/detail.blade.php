@extends('Gudang.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Barang Masuk</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Data Barang Masuk</a></li>
						<li class="breadcrumb-item active">Data Barang Masuk Detail</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="{{ url('/gudang/data-barang-masuk') }}">
								<button class="btn btn-default">
									<span class="fas fa-arrow-left"></span> Kembali
								</button>
							</a>
						</div>
						<div class="card-body">
							<table class="table table-hover" id="data-barang-masuk-detail" width="100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Jenis Barang</th>
										<th>Nama Barang</th>
										<th>Jumlah Masuk</th>
										<th>Harga Satuan</th>
										<th>Harga Total</th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection