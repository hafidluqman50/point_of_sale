<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanInventoryController extends Controller
{
    public function laporanStokBarang()
    {
		$title    = 'Laporan Stok Barang';
		$page     = 'laporan-stok-barang';
		$treeview = 'inventory';

		return view('Admin.laporan-inventory.laporan-stok-barang',compact('title','page','treeview'));
    }

    public function cetakLaporanStok()
    {
        $fileName    = 'Laporan Stok Barang '.human_date(date('Y-m-d')).'.xlsx';
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $spreadsheet->getDefaultStyle()->getFont()->setSize('12');

        $spreadsheet->getActiveSheet()->setCellValue('B2','Laporan Stok Barang');
        $spreadsheet->getActiveSheet()->setCellValue('B3',human_date(date('Y-m-d')));

        $spreadsheet->getActiveSheet()->setCellValue('B5','No.');
        $spreadsheet->getActiveSheet()->setCellValue('C5','Nama Barang');
        $spreadsheet->getActiveSheet()->setCellValue('D5','Jenis Barang');
        $spreadsheet->getActiveSheet()->setCellValue('E5','Stok Barang');

        $barang     = Barang::getData();
        $sheet_cell = 5;

        foreach ($barang as $key => $value) {
            $sheet_cell = $sheet_cell+1;

            $spreadsheet->getActiveSheet()->setCellValue('B'.$sheet_cell,$key+1);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$sheet_cell,$value->nama_barang);
            $spreadsheet->getActiveSheet()->setCellValue('D'.$sheet_cell,$value->nama_jenis);
            $spreadsheet->getActiveSheet()->setCellValue('E'.$sheet_cell,$value->stok_barang.' '.$value->satuan_stok);
        }

        $spreadsheet->getActiveSheet()->mergeCells('B2:E2');
        $spreadsheet->getActiveSheet()->mergeCells('B3:E3');

        $style_sheet = ['alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]];
        $styleTable = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];

        $spreadsheet->getActiveSheet()->getStyle('B2:E'.$sheet_cell)->applyFromArray($style_sheet);
        $spreadsheet->getActiveSheet()->getStyle('B5:E'.$sheet_cell)->applyFromArray($styleTable);
        $spreadsheet->getActiveSheet()->getStyle('B2:B3')->getFont()->setSize(14);

        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(10);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        // $writer->setIncludeCharts(true);
        $writer->save('php://output');
    }

    public function laporanMutasiBarang()
    {
		$title    = 'Laporan Mutasi Barang';
		$page     = 'laporan-mutasi-barang';
		$treeview = 'inventory';

		return view('Admin.laporan-inventory.laporan-mutasi-barang',compact('title','page','treeview'));
    }

    public function cetakLaporanMutasi(Request $request)
    {
        $fileName    = 'Laporan Mutasi Barang '.human_date($request->from).' - '.human_date($request->to).'.xlsx';
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $spreadsheet->getDefaultStyle()->getFont()->setSize('12');

        $spreadsheet->setActiveSheetIndex(0)->setTitle('Barang Masuk');

        $spreadsheet->getActiveSheet()->setCellValue('B2','Laporan Mutasi Barang');
        $spreadsheet->getActiveSheet()->setCellValue('B3',human_date($request->from).' - '.human_date($request->to));

        $spreadsheet->getActiveSheet()->setCellValue('B5','No.');
        $spreadsheet->getActiveSheet()->setCellValue('C5','Tanggal Masuk');
        $spreadsheet->getActiveSheet()->setCellValue('D5','Nama Supplier');
        $spreadsheet->getActiveSheet()->setCellValue('E5','Barang');
        $spreadsheet->getActiveSheet()->setCellValue('F5','Jenis Barang');
        $spreadsheet->getActiveSheet()->setCellValue('G5','Stok Masuk');
        $spreadsheet->getActiveSheet()->setCellValue('H5','Harga Satuan');
        $spreadsheet->getActiveSheet()->setCellValue('I5','Harga Total');
        $spreadsheet->getActiveSheet()->setCellValue('J5','Keterangan');
        $spreadsheet->getActiveSheet()->setCellValue('K5','Input By');

        $barang_masuk = BarangMasuk::join('supplier','barang_masuk.id_supplier','=','supplier.id_supplier')
                                    ->join('users','barang_masuk.id_users','=','users.id_users')
                                    ->whereBetween('tanggal_masuk',[$request->from,$request->to])
                                    ->get();
        $sheet_cell   = 5;
        $sheet_barang = 5;

        foreach ($barang_masuk as $key => $value) {
            $sheet_cell = $sheet_cell+1;

            $spreadsheet->getActiveSheet()->setCellValue('B'.$sheet_cell,$key+1);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$sheet_cell,human_date($value->tanggal_masuk));
            $spreadsheet->getActiveSheet()->setCellValue('D'.$sheet_cell,$value->nama_supplier);

            $barang_masuk_detail = BarangMasukDetail::join('barang','barang_masuk_detail.id_barang','=','barang.id_barang')
                                                    ->join('jenis_barang','barang.id_jenis_barang','=','jenis_barang.id_jenis_barang')
                                                    ->where('id_barang_masuk',$value->id_barang_masuk)
                                                    ->get();
            // dd($barang_masuk_detail);

            foreach ($barang_masuk_detail as $data) {
                $sheet_barang = $sheet_barang+1;

                $spreadsheet->getActiveSheet()->setCellValue('E'.$sheet_barang,$data->nama_barang);
                $spreadsheet->getActiveSheet()->setCellValue('F'.$sheet_barang,$data->nama_jenis);
                $spreadsheet->getActiveSheet()->setCellValue('G'.$sheet_barang,$data->jumlah_masuk.' '.$data->satuan_stok);
                $spreadsheet->getActiveSheet()->setCellValue('H'.$sheet_barang,format_rupiah($data->harga_satuan));
                $spreadsheet->getActiveSheet()->setCellValue('I'.$sheet_barang,format_rupiah($data->harga_total));
            }
            
            $spreadsheet->getActiveSheet()->setCellValue('J'.$sheet_cell,$value->keterangan);
            $spreadsheet->getActiveSheet()->setCellValue('K'.$sheet_cell,$value->name);

            $spreadsheet->getActiveSheet()->mergeCells('B'.$sheet_cell.':B'.$sheet_barang);
            $spreadsheet->getActiveSheet()->mergeCells('C'.$sheet_cell.':C'.$sheet_barang);
            $spreadsheet->getActiveSheet()->mergeCells('D'.$sheet_cell.':D'.$sheet_barang);
            $spreadsheet->getActiveSheet()->mergeCells('J'.$sheet_cell.':J'.$sheet_barang);
            $spreadsheet->getActiveSheet()->mergeCells('K'.$sheet_cell.':K'.$sheet_barang);

            $sheet_cell = $sheet_barang;
        }

        $spreadsheet->getActiveSheet()->mergeCells('B2:K2');
        $spreadsheet->getActiveSheet()->mergeCells('B3:K3');

        $style_sheet = ['alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]];
        $styleTable = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];

        $spreadsheet->getActiveSheet()->getStyle('B2:K'.$sheet_cell)->applyFromArray($style_sheet);
        $spreadsheet->getActiveSheet()->getStyle('B5:K'.$sheet_cell)->applyFromArray($styleTable);
        $spreadsheet->getActiveSheet()->getStyle('B2:B3')->getFont()->setSize(14);

        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(10);

        $spreadsheet->createSheet();

        $spreadsheet->setActiveSheetIndex(1)->setTitle('Barang Keluar');
        $spreadsheet->getActiveSheet()->setCellValue('B2','Laporan Mutasi Barang');
        $spreadsheet->getActiveSheet()->setCellValue('B3',human_date($request->from).' - '.human_date($request->to));

        $spreadsheet->getActiveSheet()->setCellValue('B5','No.');
        $spreadsheet->getActiveSheet()->setCellValue('C5','Tanggal Keluar');
        $spreadsheet->getActiveSheet()->setCellValue('D5','Barang');
        $spreadsheet->getActiveSheet()->setCellValue('E5','Jenis Barang');
        $spreadsheet->getActiveSheet()->setCellValue('F5','Stok Keluar');
        $spreadsheet->getActiveSheet()->setCellValue('G5','Keterangan');
        $spreadsheet->getActiveSheet()->setCellValue('H5','Input By');

        $barang_keluar = BarangKeluar::join('users','barang_keluar.id_users','=','users.id_users')
                                    ->whereBetween('tanggal_keluar',[$request->from,$request->to])
                                    ->get();
        $sheet_cell   = 5;
        $sheet_barang = 5;

        foreach ($barang_keluar as $key => $value) {
            $sheet_cell = $sheet_cell+1;

            $spreadsheet->getActiveSheet()->setCellValue('B'.$sheet_cell,$key+1);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$sheet_cell,human_date($value->tanggal_keluar));

            $barang_keluar_detail = BarangKeluarDetail::join('barang','barang_keluar_detail.id_barang','=','barang.id_barang')
                                                    ->join('jenis_barang','barang.id_jenis_barang','=','jenis_barang.id_jenis_barang')
                                                    ->where('id_barang_keluar',$value->id_barang_keluar)
                                                    ->get();
            // dd($barang_masuk_detail);

            foreach ($barang_keluar_detail as $data) {
                $sheet_barang = $sheet_barang+1;

                $spreadsheet->getActiveSheet()->setCellValue('D'.$sheet_barang,$data->nama_barang);
                $spreadsheet->getActiveSheet()->setCellValue('E'.$sheet_barang,$data->nama_jenis);
                $spreadsheet->getActiveSheet()->setCellValue('F'.$sheet_barang,$data->jumlah_barang.' '.$data->satuan_stok);
            }
            
            $spreadsheet->getActiveSheet()->setCellValue('G'.$sheet_cell,$value->keterangan);
            $spreadsheet->getActiveSheet()->setCellValue('H'.$sheet_cell,$value->name);

            $spreadsheet->getActiveSheet()->mergeCells('B'.$sheet_cell.':B'.$sheet_barang);
            $spreadsheet->getActiveSheet()->mergeCells('C'.$sheet_cell.':C'.$sheet_barang);
            $spreadsheet->getActiveSheet()->mergeCells('G'.$sheet_cell.':G'.$sheet_barang);
            $spreadsheet->getActiveSheet()->mergeCells('H'.$sheet_cell.':H'.$sheet_barang);

            $sheet_cell = $sheet_barang;
        }

        $spreadsheet->getActiveSheet()->mergeCells('B2:H2');
        $spreadsheet->getActiveSheet()->mergeCells('B3:H3');

        $style_sheet = ['alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]];
        $styleTable = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];

        $spreadsheet->getActiveSheet()->getStyle('B2:H'.$sheet_cell)->applyFromArray($style_sheet);
        $spreadsheet->getActiveSheet()->getStyle('B5:H'.$sheet_cell)->applyFromArray($styleTable);
        $spreadsheet->getActiveSheet()->getStyle('B2:B3')->getFont()->setSize(14);

        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(10);

        $spreadsheet->setActiveSheetIndex(0);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        // $writer->setIncludeCharts(true);
        $writer->save('php://output');
    }
}
