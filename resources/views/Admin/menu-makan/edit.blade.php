@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Menu Makan Edit</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Menu Makan</a></li>
						<li class="breadcrumb-item active">Menu Makan Edit</li>
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
						<a href="{{ url('/admin/menu-makan') }}">
							<button class="btn btn-default">
								<span class="fas fa-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{ url('/admin/menu-makan/update/'.$id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama Menu</label>
								<input type="text" name="nama_menu" class="form-control" value="{{ $row->nama_menu }}" required placeholder="Isi Nama Menu" autofocus>
							</div>
							<div class="form-group">
								<label for="">Harga Menu</label>
								<input type="number" name="harga_menu" class="form-control" value="{{ $row->harga_menu }}" required placeholder="Isi Harga Menu">
							</div>
							<div class="form-group">
								<label for="">Foto Menu</label>
								<input type="file" name="foto_menu" class="form-control">
								<img src="{{ asset('assets/foto_menu/'.$row->foto_menu) }}" class="img-fluid img-thumbnail" alt="">
							</div>
							<div class="form-group">
								<label for="">Status Menu</label>
								<select name="status_menu" class="form-control" required>
									<option value="" selected disabled>=== Pilih Status Menu ===</option>
									<option value="tersedia" {!!$row->status_menu == 'tersedia' ? 'selected="selected"' : ''!!}>Tersedia</option>
									<option value="kosong" {!!$row->status_menu == 'kosong' ? 'selected="selected"' : ''!!}>Kosong</option>
								</select>
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