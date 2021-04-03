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
					<form action="{{ url('/admin/users/save') }}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" class="form-control" name="name" placeholder="Isi Nama" required="required">
							</div>
							<div class="form-group">
								<label for="">Username</label>
								<input type="text" class="form-control" name="username" placeholder="Isi Username" required="required">
							</div>
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" class="form-control" name="password" placeholder="Isi Password" required="required">
							</div>
							<div class="form-group">
								<label for="">Level User</label>
								<select name="level_user" class="form-control" required="required">
									<option value="" selected="" disabled="">=== Pilih Level User ===</option>
									<option value="1">Gudang</option>
									<option value="0">Kasir</option>
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