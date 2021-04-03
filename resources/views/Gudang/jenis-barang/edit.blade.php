@extends('Gudang.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Jenis Barang Edit</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Data Jenis Barang</a></li>
						<li class="breadcrumb-item active">Data Jenis Barang Edit</li>
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
						<a href="{{ url('/gudang/data-jenis-barang') }}">
							<button class="btn btn-default">
								<span class="fas fa-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{ url('/gudang/data-jenis-barang/update/'.$id) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama Jenis</label>
								<input type="text" name="nama_jenis" class="form-control" value="{{ $row->nama_jenis }}" placeholder="Isi Nama Jenis Barang" required>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-warning">Edit <span class="fas fa-pencil-alt"></span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection