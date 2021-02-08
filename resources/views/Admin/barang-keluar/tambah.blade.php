@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Barang</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Data Barang</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<form action="{{ url('/admin/data-barang-keluar/save') }}" method="POST">
				@csrf
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<a href="{{ url('/admin/data-barang-keluar') }}">
									<button class="btn btn-default" type="button">
										<span class="fas fa-arrow-left"></span> Kembali
									</button>
								</a>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label for="">Tanggal Barang Keluar</label>
									<input type="date" name="tanggal_barang_keluar" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="">Keterangan</label>
									<textarea name="keterangan" class="form-control" cols="30" rows="5"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div id="append">
									<div class="row" id="input-barang" div-input="1" style="border-bottom:1px solid lightgray; margin-bottom:1%;">
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Jenis Barang</label>
												<select name="jenis_barang[]" class="form-control select2 jenis-barang" num-input="1" required>
													<option value="" selected disabled>=== Pilih Jenis Barang ===</option>
													@foreach ($jenis_barang as $row)
													<option value="{{ $row->id_jenis_barang }}">{{ $row->nama_jenis }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Barang</label>
												<select name="barang[]" class="form-control select2 barang" num-input="1" required disabled>
													<option value="" selected disabled>=== Pilih Barang ===</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Satuan Stok</label>
												<input type="text" name="satuan_stok[]" class="form-control satuan-stok" num-input="1" readonly>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Jumlah Keluar</label>
												<input type="number" name="jumlah_keluar[]" class="form-control jumlah-keluar" num-input="1" required placeholder="Isi Jumlah Keluar">
											</div>
										</div>
									</div>
								</div>
								<button class="btn btn-success" id="tambah-input" type="button">Tambah Input</button>
								<button class="btn btn-danger hide-btn" id="hapus-input" type="button">Hapus Input</button>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary">
									Simpan <span class="fas fa-save"></span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
@endsection