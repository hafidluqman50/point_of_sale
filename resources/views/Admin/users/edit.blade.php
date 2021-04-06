@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">User</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">User</a></li>
						<li class="breadcrumb-item active">User Tambah</li>
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
						<a href="{{ url('/admin/users') }}">
							<button class="btn btn-default">
								<span class="fas fa-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					@if(old('username') != '')
					<div class="alert alert-danger alert-dismissible fade show">
						Username Sudah Digunakan <button class="close" data-dismiss="alert">X</button>
					</div>
					@endif
					<form action="{{ url('/admin/users/update/'.$id) }}" method="POST" oninput="re_type_password.setCustomValidity(re_type_password.value != password.value ? 'Passwords do not match.' : '')">
						@csrf
						@method('PUT')
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" name="nama" class="form-control" value="{{ old('nama') != '' ? old('nama') : $row->name }}">
							</div>
							<div class="form-group">
								<label for="">Username</label>
								<input type="text" name="username" class="form-control" value="{{ old('username') != '' ? old('username') : $row->username }}" disabled="disabled">
								<input type="checkbox" id="sip"> Ubah Username
							</div>
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group">
								<label for="">Re-type Password</label>
								<input type="password" name="re_type_password" class="form-control">
							</div>
							<div class="form-group">
								<label for="">Level User</label>
								<select name="level_user" class="form-control" required="required">
									<option value="" selected="" disabled="">=== Pilih Level User ===</option>
									<option value="1" {!!$row->level_user == 1 ? 'selected="selected"' : ''!!}>Gudang</option>
									<option value="0" {!!$row->level_user == 0 ? 'selected="selected"' : ''!!}>Kasir</option>
								</select>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-warning">Edit <span class="fas fa-save"></span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('js')
<script>
	$(function(){
		$('#sip').click(function(){
			if ($(this).is(':checked')) {
				$('input[name="username"]').removeAttr('disabled');
			}
			else {
				$('input[name="username"]').attr('disabled','disabled');
			}
		});
	});
</script>
@endsection