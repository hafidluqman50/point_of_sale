@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Info Outlet</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Info Outlet</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					@if(session()->has('message'))
					<div class="alert alert-success alert-dismissible fade show">
						{{ session('message') }} <button class="close" data-dismiss="alert">X</button>
					</div>
					@endif
					<form action="{{ url('/admin/info-outlet/save') }}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama Outlet</label>
								<input type="text" class="form-control" name="nama_outlet" placeholder="Isi Nama Outlet" required="required" value="{{ isset($row) ? $row->nama_outlet : '' }}">
							</div>
							<div class="form-group">
								<label for="">Alamat Outlet</label>
								<textarea name="alamat_outlet" class="form-control" cols="30" rows="10" required="required" placeholder="Isi Alamat Outlet">{{ isset($row) ? $row->alamat_outlet : '' }}</textarea>
							</div>
							<div class="form-group">
								<label for="">Nomor Telepon</label>
								<input type="number" class="form-control" name="nomor_telepon" placeholder="Isi Password" required="required" value="{{ isset($row) ? $row->nomor_telepon : '' }}">
							</div>
							<div class="form-group">
								<label for="">Catatan</label>
								<input type="text" class="form-control" name="catatan" placeholder="Isi Catatan; Ex: Password Wifi : 12345;" value="{{ isset($row) ? $row->catatan : '' }}">
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="id_info_outlet" value="{{ isset($row) ? $row->id_info_outlet : '' }}">
							@if (isset($row))
							<button class="btn btn-warning">Edit <span class="fas fa-save"></span></button>
							@else
							<button class="btn btn-primary">Simpan <span class="fas fa-save"></span></button>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection