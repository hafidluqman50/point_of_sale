@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Barang Edit</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Data Barang</a></li>
						<li class="breadcrumb-item active">Data Barang Edit</li>
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
						<a href="{{ url('/admin/data-barang') }}">
							<button class="btn btn-default">
								<span class="fas fa-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{ url('/admin/data-barang/update/'.$id) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama Barang</label>
								<input type="text" name="nama_barang" class="form-control" value="{{ $row->nama_barang }}" placeholder="Isi Nama Barang" required>
							</div>
							<div class="form-group">
								<label for="">Jenis Barang</label>
								<select name="jenis_barang" class="form-control select2" required>
									<option value="" selected disabled>=== Pilih Jenis Barang ===</option>
									@foreach ($jenis_barang as $element)
									<option value="{{ $element->id_jenis_barang }}" {!!$row->id_jenis_barang == $element->id_jenis_barang ? 'selected="selected"' : ''!!}>{{ $element->nama_jenis }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Stok Barang</label>
								<input type="number" name="stok_barang" class="form-control" value="{{ $row->stok_barang }}" placeholder="Isi Stok Barang" required>
							</div>
							<div class="form-group">
								<label for="">Satuan Stok</label>
								<input type="text" name="satuan_stok" class="form-control" value="{{ $row->satuan_stok }}" placeholder="Isi Satuan Stok" required>
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