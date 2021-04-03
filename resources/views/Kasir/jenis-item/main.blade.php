@extends('Kasir.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Jenis Item</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Data Jenis Item</li>
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
							<a href="{{ url('/kasir/data-jenis-item/tambah') }}">
								<button class="btn btn-primary">
									Tambah Data
								</button>
							</a>
						</div>
						<div class="card-body">
							@if(session()->has('message'))
							<div class="alert alert-success alert-dismissible fade show">
								{{ session('message') }} <button class="close" data-dismiss="alert">X</button>
							</div>
							@endif
							<table class="table table-hover" id="data-jenis-item" width="100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Nama Jenis</th>
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