@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Tagihan</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Tagihan</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row justify-content-center align-items-center">
							<div class="col-md-12 row">
								<div class="col-md-4">
									<div class="form-group row">
										<label for="" class="col-md-4 col-form-label">From</label>
										<input type="date" name="from" class="form-control col-md-8">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group row">
										<label for="" class="col-md-4 col-form-label">To</label>
										<input type="date" name="to" class="form-control col-md-8">
									</div>
								</div>
								<div class="col-md-4">
									<button class="btn btn-success">Export <span class="fas fa-file-excel"></span></button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						@if(session()->has('message'))
						<div class="alert alert-success alert-dismissible fade show">
							{{ session('message') }} <button class="close" data-dismiss="alert">X</button>
						</div>
						@endif
						<table class="table table-hover" id="tagihan" width="100%">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Customer</th>
									<th>Total Tagihan</th>
									<th>Keterangan</th>
									<th>Status Tagihan</th>
									<th>Input By</th>
									<th>#</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection