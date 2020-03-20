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
});