@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Item Jual Tambah</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Item Jual</a></li>
						<li class="breadcrumb-item active">Item Jual Tambah</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<form action="{{ url('/admin/item-jual/save') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<a href="{{ url('/admin/item-jual') }}">
								<button class="btn btn-default" type="button">
									<span class="fas fa-arrow-left"></span> Kembali
								</button>
							</a>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama Item</label>
								<input type="text" name="nama_item" class="form-control" required placeholder="Isi Nama Item" autofocus>
							</div>
							<div class="form-group">
								<label for="">Harga Item</label>
								<input type="number" name="harga_item" class="form-control" required placeholder="Isi Harga Item">
							</div>
							<div class="form-group">
								<label for="">Foto Item</label>
								<input type="file" name="foto_item" class="form-control">
							</div>
							<div class="form-group">
								<label for="">Status Item</label>
								<select name="status_item" class="form-control" required>
									<option value="" selected disabled>=== Pilih Status Item ===</option>
									<option value="tersedia">Tersedia</option>
									<option value="kosong">Kosong</option>
								</select>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary" type="submit">Simpan <span class="fas fa-save"></span></button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<button class="btn btn-info btn-input-varian" type="button">Input Varian</button>
						</div>
						<div class="card-body">
							<button class="btn btn-success btn-varian-tambah is-hide" type="button">Tambah Varian</button>
							<button class="btn btn-danger btn-varian-hapus is-hide" type="button">Hapus Varian</button>
							<hr>
							<div id="form-varian-layout">
								<div class="form-group is-hide form-varian" id="form-varian">
									<label for="">Varian Item</label>
									<div class="row">
										<div class="col-md-6">
											<input type="text" name="nama_varian[]" class="form-control" placeholder="Nama Varian Item">	
										</div>
										<div class="col-md-6">
											<input type="text" name="harga_varian[]" class="form-control" placeholder="Harga Varian Item">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
@endsection