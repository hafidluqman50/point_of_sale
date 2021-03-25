<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TransaksiController extends Controller
{
    public function index()
    {
		$title = 'Transaksi';
		$page  = 'transaksi';

		return view('Admin.transaksi.main',compact('title','page'));
    }

    public function delete($id)
    {
    	Transaksi::where('id_transaksi',$id)->delete();

    	return redirect('/admin/transaksi')->with('message','Berhasil Hapus Transaksi');
    }

    public function laporanTransaksi(Request $request)
    {
        $fileName    = 'Laporan Transaksi '.human_date($request->from).' - '.human_date($request->to).'.xlsx';
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $spreadsheet->getDefaultStyle()->getFont()->setSize('12');

        $spreadsheet->getActiveSheet()->setCellValue('B2','Laporan Transaksi');
        $spreadsheet->getActiveSheet()->setCellValue('B3',human_date($request->from).' - '.human_date($request->to));

        $spreadsheet->getActiveSheet()->setCellValue('B5','No.');
        $spreadsheet->getActiveSheet()->setCellValue('C5','Tanggal Transaksi');
        $spreadsheet->getActiveSheet()->setCellValue('D5','Total Harga');
        $spreadsheet->getActiveSheet()->setCellValue('E5','Total Bayar');
        $spreadsheet->getActiveSheet()->setCellValue('F5','Input By');
        $spreadsheet->getActiveSheet()->setCellValue('G5','Keterangan');

        $transaksi  = Transaksi::reportData($request->from,$request->to);
        $sheet_cell = 5;

        foreach ($transaksi as $key => $value) {
            $sheet_cell = $sheet_cell+1;

            $spreadsheet->getActiveSheet()->setCellValue('B'.$sheet_cell,$key+1);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$sheet_cell,human_date($value->tanggal_transaksi));
            $spreadsheet->getActiveSheet()->setCellValue('D'.$sheet_cell,format_rupiah($value->total_harga));
            $spreadsheet->getActiveSheet()->setCellValue('E'.$sheet_cell,format_rupiah($value->total_bayar));
            $spreadsheet->getActiveSheet()->setCellValue('F'.$sheet_cell,$value->name);
            $spreadsheet->getActiveSheet()->setCellValue('G'.$sheet_cell,unslug_str($value->ket_bayar));
        }

        $spreadsheet->getActiveSheet()->mergeCells('B2:G2');
        $spreadsheet->getActiveSheet()->mergeCells('B3:G3');

        $style_sheet = ['alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]];
        $styleTable = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];

        $spreadsheet->getActiveSheet()->getStyle('B2:G'.$sheet_cell)->applyFromArray($style_sheet);
        $spreadsheet->getActiveSheet()->getStyle('B5:G'.$sheet_cell)->applyFromArray($styleTable);
        $spreadsheet->getActiveSheet()->getStyle('B2:B3')->getFont()->setSize(14);

        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(17);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        // $writer->setIncludeCharts(true);
        $writer->save('php://output');
    }
}
