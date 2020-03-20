@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Supplier</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Supplier</a></li>
						<li class="breadcrumb-item active">Supplier Tambah</li>
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
						<a href="{{ url('/admin/data-supplier') }}">
							<button class="btn btn-default">
								<span class="fas fa-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{ url('/admin/data-supplier/update/'.$id) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama Supplier</label>
								<input type="text" name="nama_supplier" class="form-control" value="{{ $row->nama_supplier }}" required placeholder="Isi Nama Supplier">
							</div>
							<div class="form-group">
								<label for="">Nomor Telepon</label>
								<input type="number" name="nomor_telepon" class="form-control" value="{{ $row->nomor_telepon_supplier }}" required placeholder="Isi Nomor Telepon">
							</div>
							<div class="form-group">
								<label for="">Alamat Supplier</label>
								<textarea name="alamat_supplier" class="form-control" cols="30" rows="10" required placeholder="Isi Alamat Supplier">{{$row->alamat_supplier}}</textarea>
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