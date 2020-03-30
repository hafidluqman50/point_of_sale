$(function(){
    $('.select2').select2();
    
    var getUrlHost = window.location.origin;
    var urlSegment = window.location.pathname.split('/');

    var menu_makan = $('#menu-makan').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/menu-makan',
        columns:[
            {data:'id_menu_makan',searchable:false,render:function(data,type,row,meta){
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_menu',name:'nama_menu'},
            {data:'harga_menu',name:'harga_menu'},
            {data:'foto_menu',name:'foto_menu'},
            {data:'status_menu',name:'status_menu'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    });
    menu_makan.on( 'order.dt search.dt', function () {
        menu_makan.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        	cell.innerHTML = i+1;
        });
    }).draw();

    var jenis_barang = $('#data-jenis-barang').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-jenis-barang',
        columns:[
            {data:'id_jenis_barang',searchable:false,render:function(data,type,row,meta){
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_jenis',name:'nama_jenis'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    });
    jenis_barang.on( 'order.dt search.dt', function () {
        jenis_barang.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();

    var barang = $('#data-barang').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang',
        columns:[
            {data:'id_barang',searchable:false,render:function(data,type,row,meta){
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_barang',name:'nama_barang'},
            {data:'nama_jenis',name:'nama_jenis'},
            {data:'stok_barang',name:'stok_barang'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    });
    barang.on( 'order.dt search.dt', function () {
        barang.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();

    var supplier = $('#data-supplier').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-supplier',
        columns:[
            {data:'id_supplier',searchable:false,render:function(data,type,row,meta){
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_supplier',name:'nama_supplier'},
            {data:'nomor_telepon_supplier',name:'nomor_telepon_supplier'},
            {data:'alamat_supplier',name:'alamat_supplier'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    });
    supplier.on( 'order.dt search.dt', function () {
        supplier.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();

    var barang_masuk = $('#data-barang-masuk').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang-masuk',
        columns:[
            {data:'id_barang_masuk',searchable:false,render:function(data,type,row,meta){
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'tanggal_barang_masuk',name:'tanggal_barang_masuk'},
            {data:'nama_supplier',name:'nama_supplier'},
            {data:'keterangan',name:'keterangan'},
            {data:'name',name:'name'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    });
    barang_masuk.on( 'order.dt search.dt', function () {
        barang_masuk.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();

    var barang_keluar = $('#data-barang-keluar').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang-keluar',
        columns:[
            {data:'id_barang_keluar',searchable:false,render:function(data,type,row,meta){
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'tanggal_barang_keluar',name:'tanggal_barang_keluar'},
            {data:'keterangan',name:'keterangan'},
            {data:'name',name:'name'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    });
    barang_keluar.on( 'order.dt search.dt', function () {
        barang_keluar.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();

    var transaksi = $('#transaksi').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-transaksi',
        columns:[
            {data:'id_transaksi',searchable:false,render:function(data,type,row,meta){
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'tanggal_transaksi',name:'tanggal_transaksi'},
            {data:'total_harga',name:'total_harga'},
            {data:'name',name:'name'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    });
    transaksi.on( 'order.dt search.dt', function () {
        transaksi.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();

    var transaksi_detail = $('#transaksi-detail').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-transaksi/detail/'+urlSegment[4],
        columns:[
            {data:'id_transaksi_detail',searchable:false,render:function(data,type,row,meta){
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_menu',name:'nama_menu'},
            {data:'banyak_pesan',name:'banyak_pesan'},
            {data:'sub_total',name:'sub_total'},
            {data:'keterangan',name:'keterangan'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    });
    transaksi_detail.on( 'order.dt search.dt', function () {
        transaksi_detail.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();

    var users = $('#data-users').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-users',
        columns:[
            {data:'id_users',searchable:false,render:function(data,type,row,meta){
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'name',name:'name'},
            {data:'username',name:'username'},
            {data:'status_akun',name:'status_akun'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    });
    users.on( 'order.dt search.dt', function () {
        users.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
});