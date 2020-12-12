$(() => {

    $('.select2').select2()
    
    var getUrlHost = window.location.origin
    var urlSegment = window.location.pathname.split('/')

    let item_jual = $('#item-jual').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/item-jual',
        columns:[
            {data:'id_item_jual',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_item',name:'nama_item'},
            {data:'harga_item',name:'harga_item'},
            {data:'foto_item',name:'foto_item'},
            {data:'status_item',name:'status_item'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        ordering:false,
        scrollX:true,
        responsive:true,
        fixedColumns: true
    })
    item_jual.on( 'order.dt search.dt',() => {
        item_jual.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
        	cell.innerHTML = i+1;
        })
    }).draw()

    let jenis_barang = $('#data-jenis-barang').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-jenis-barang',
        columns:[
            {data:'id_jenis_barang',searchable:false,render:(data,type,row,meta) => {
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
    })
    jenis_barang.on( 'order.dt search.dt',() => {
        jenis_barang.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let barang = $('#data-barang').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang',
        columns:[
            {data:'id_barang',searchable:false,render:(data,type,row,meta) => {
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
    })
    barang.on( 'order.dt search.dt',() => {
        barang.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let supplier = $('#data-supplier').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-supplier',
        columns:[
            {data:'id_supplier',searchable:false,render:(data,type,row,meta) => {
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
    })
    supplier.on( 'order.dt search.dt',() => {
        supplier.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let barang_masuk = $('#data-barang-masuk').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang-masuk',
        columns:[
            {data:'id_barang_masuk',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'tanggal_masuk',name:'tanggal_masuk'},
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
        order: [[ 1, 'asc' ]],
        responsive:true,
        fixedColumns: true
    })
    barang_masuk.on( 'order.dt search.dt',() => {
        barang_masuk.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let barang_masuk_detail = $('#data-barang-masuk-detail').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang-masuk/detail/'+urlSegment[4],
        columns:[
            {data:'id_barang_masuk_detail',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_jenis',name:'nama_jenis'},
            {data:'nama_barang',name:'nama_barang'},
            {data:'jumlah_masuk',name:'jumlah_masuk'},
            {data:'harga_satuan',name:'harga_satuan'},
            {data:'harga_total',name:'harga_total'},
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
    })
    barang_masuk_detail.on( 'order.dt search.dt',() => {
        barang_masuk_detail.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let barang_keluar = $('#data-barang-keluar').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang-keluar',
        columns:[
            {data:'id_barang_keluar',searchable:false,render:(data,type,row,meta) => {
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
        order: [[ 1, 'asc' ]],
        responsive:true,
        fixedColumns: true
    })
    barang_keluar.on( 'order.dt search.dt',() => {
        barang_keluar.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let transaksi = $('#transaksi').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-transaksi',
        columns:[
            {data:'id_transaksi',searchable:false,orderable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'tanggal_transaksi',name:'tanggal_transaksi'},
            {data:'total_harga',name:'total_harga'},
            {data:'total_bayar',name:'total_bayar'},
            {data:'name',name:'name'},
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
    })
    transaksi.on( 'order.dt search.dt',() => {
        transaksi.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let transaksi_detail = $('#transaksi-detail').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-transaksi/detail/'+urlSegment[4],
        columns:[
            {data:'id_transaksi_detail',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_item',name:'nama_item'},
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
    })
    transaksi_detail.on( 'order.dt search.dt',() => {
        transaksi_detail.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let users = $('#data-users').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-users',
        columns:[
            {data:'id_users',searchable:false,render:(data,type,row,meta) => {
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
    })
    users.on( 'order.dt search.dt',() => {
        users.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    var numInput = 1

    $('#tambah-input').click(() => {
        numInput++
        $('#hapus-input').removeClass('hide-btn')

        $('.row').find('.select2').select2().select2('destroy')

        $('#input-barang').clone().appendTo($('#append')).attr('div-input',numInput)

        let divInput = $(`#input-barang[div-input="${numInput}"]`)

        divInput.find('select,input').attr('num-input',numInput)
        divInput.find('input').val('')

        $('.row').find('.select2').select2()
    })

    $(document).on('change','.jenis-barang',(el) => {
        let val    = $(el.target).val()
        let getNum = $(el.target).attr('num-input')

        $.ajax({
            url: getUrlHost+'/ajax/data-barang/'+val
        })
        .done((done) => {
            let barangSelect = $(`.barang[num-input="${getNum}"]`)

            barangSelect.removeAttr('disabled')
            
            barangSelect.find('option').not(':first').remove()

            $.each(done, (index,element) => {
                let barangOption = `<option value="${element.id_barang}" stock-type="${element.satuan_stok}">
                                        ${element.nama_barang}
                                    </option>`

                barangSelect.append(barangOption)
            })
        })
        .fail((fail) => {
            console.log(fail)
        })

    })

    $(document).on('change','.barang',(el) => {
        let getNum      = $(el.target).attr('num-input')
        let getStokType = $(el.target).children('option:selected').attr('stock-type')

        $(`.satuan-stok[num-input="${getNum}"]`).val(getStokType)
    })

    $(document).on('keyup','.jumlah-masuk',(el) => {
        let getNum         = $(el.target).attr('num-input')
        let getVal         = $(el.target).val()
        let getHargaSatuan = $(`.harga-satuan[num-input="${getNum}"]`).val()

        if (getHargaSatuan != 0 || getHargaSatuan != null) {
            let hargaTotal = getVal * getHargaSatuan

            $(`.harga-total[num-input="${getNum}"]`).val(hargaTotal)
        }
    })

    $(document).on('keyup','.harga-satuan',(el) => {
        let getNum         = $(el.target).attr('num-input')
        let getVal         = $(el.target).val()
        let getJumlahMasuk = $(`.jumlah-masuk[num-input="${getNum}"]`).val()

        if (getJumlahMasuk != 0 || getJumlahMasuk != null) {
            let hargaTotal = getVal * getJumlahMasuk

            $(`.harga-total[num-input="${getNum}"]`).val(hargaTotal)
        }
    })

    $('.btn-input-varian').click(() => {
        if ($('.btn-varian-tambah').hasClass('is-hide')) {
            $('.btn-varian-tambah').removeClass('is-hide')
            $('#form-varian').removeClass('is-hide')
            $('.form-varian').find('input').attr('required','required')
        }
        else {
            $('.btn-varian-tambah').addClass('is-hide')
            $('#form-varian').addClass('is-hide')
            $('.form-varian').find('input').removeAttr('required')
        }
    })

    $('.btn-varian-tambah').click(() => {
        $('#form-varian').clone().appendTo($('#form-varian-layout'))
        if ($('.form-varian').length > 1) {
            $('.btn-varian-hapus').removeClass('is-hide')
        }
        // $('#form-varian').clone().appendTo()
    })

    $('.btn-varian-hapus').click(() => {
        $('#form-varian').remove().eq(1)

        if ($('.form-varian').length == 1) {
            console.log('okay')
            $('.btn-varian-hapus').addClass('is-hide')
        }
        // $('#form-varian').
    })
})
