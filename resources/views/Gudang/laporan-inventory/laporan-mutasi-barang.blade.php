@extends('Gudang.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Laporan Stok Barang</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Data Barang</li>
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
							<form action="{{ url('/gudang/laporan-inventory/cetak-laporan-mutasi') }}" method="GET">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group row">
											<label for="" class="col-md-3 col-form-label">From</label>
											<input type="date" name="from" class="form-control col-md-8">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group row">
											<label for="" class="col-md-3 col-form-label">To</label>
											<input type="date" name="to" class="form-control col-md-8">
										</div>
									</div>
									<div class="col-md-4">
										<button class="btn btn-success">Export <span class="fas fa-file-excel"></span></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection