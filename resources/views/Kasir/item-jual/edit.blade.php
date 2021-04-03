@extends('Kasir.layout.layout-app')

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
						<a href="{{ url('/kasir/data-item-jual') }}">
							<button class="btn btn-default">
								<span class="fas fa-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{ url('/kasir/data-item-jual/update/'.$id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama Menu</label>
								<input type="text" name="nama_item" class="form-control" value="{{ $row->nama_item }}" required placeholder="Isi Nama Menu" autofocus>
							</div>
							<div class="form-group">
								<label for="">Harga Menu</label>
								<input type="number" name="harga_item" class="form-control" value="{{ $row->harga_item }}" required placeholder="Isi Harga Menu">
							</div>
							<div class="form-group">
								<label for="">Foto Menu</label>
								<input type="file" name="foto_item" class="form-control">
								<img src="{{ asset('assets/foto_item/'.$row->foto_item) }}" class="img-fluid img-thumbnail" alt="">
							</div>
							<div class="form-group">
								<label for="">Jenis Item</label>
								<select name="jenis_item" class="form-control select2" required>
									<option value="" selected="" disabled="">=== Pilih Jenis Item ===</option>
									@foreach ($jenis_item as $element)
									<option value="{{$element->id_jenis_item}}" {!!$row->id_jenis_item == $element->id_jenis_item ? 'selected="selected"' : ''!!}>{{$element->nama_jenis}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Status Menu</label>
								<select name="status_item" class="form-control" required>
									<option value="" selected disabled>=== Pilih Status Menu ===</option>
									<option value="tersedia" {!!$row->status_item == 'tersedia' ? 'selected="selected"' : ''!!}>Tersedia</option>
									<option value="kosong" {!!$row->status_item == 'kosong' ? 'selected="selected"' : ''!!}>Kosong</option>
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