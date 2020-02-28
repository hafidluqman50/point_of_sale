@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Menu Makan Tambah</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Menu Makan</a></li>
						<li class="breadcrumb-item active">Menu Makan Tambah</li>
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
					<form action="{{ url('/admin/menu-makan/save') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama Menu</label>
								<input type="text" name="nama_menu" class="form-control" required placeholder="Isi Nama Menu" autofocus>
							</div>
							<div class="form-group">
								<label for="">Harga Menu</label>
								<input type="number" name="harga_menu" class="form-control" required placeholder="Isi Harga Menu">
							</div>
							<div class="form-group">
								<label for="">Foto Menu</label>
								<input type="file" name="foto_menu" class="form-control">
							</div>
							<div class="form-group">
								<label for="">Status Menu</label>
								<select name="status_menu" class="form-control" required>
									<option value="" selected disabled>=== Pilih Status Menu ===</option>
									<option value="tersedia">Tersedia</option>
									<option value="kosong">Kosong</option>
								</select>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary">Simpan <span class="fas fa-save"></span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection