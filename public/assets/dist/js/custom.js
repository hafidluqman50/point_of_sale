$(function(){
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
});