<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagihanDetail extends Model
{
	protected $table      = 'tagihan_detail';
	protected $primaryKey = 'id_tagihan_detail';
    protected $keyType    = 'string';
    protected $guarded    = [];
    public $incrementing  = false;

    public static function getData($id_tagihan,$page = '')
    {
    	$get = self::join('item_jual','tagihan_detail.id_item_jual','=','item_jual.id_item_jual')
    				->where('id_tagihan',$id_tagihan)
                    ->where('status_tagihan_detail','belum-dibayar')
                    ->offset($page)
                    ->limit(5)
    				->get();

    	return $get;
    }

    public static function cariData($id_tagihan,$cari,$page)
    {
        $get = self::join('item_jual','tagihan_detail.id_item_jual','=','item_jual.id_item_jual')
                    ->where('id_tagihan',$id_tagihan)
                    ->where('status_tagihan_detail','belum-dibayar')
                    ->where('nama_item','like','%'.$cari.'%')
                    ->offset($page)
                    ->limit(5)
                    ->get();

        return $get;   
    }

    public static function getDataAll($id_tagihan)
    {
        $get = self::join('item_jual','tagihan_detail.id_item_jual','=','item_jual.id_item_jual')
                    ->where('id_tagihan',$id_tagihan)
                    ->get();

        return $get;
    }
}
