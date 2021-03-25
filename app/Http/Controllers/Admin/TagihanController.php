<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TagihanController extends Controller
{
    public function index()
    {
		$title = 'Tagihan';
		$page  = 'tagihan';

    	return view('Admin.tagihan.main',compact('title','page'));
    }

    public function delete($id)
    {
    	Tagihan::where('id_tagihan',$id)->delete();

    	return redirect('/admin/tagihan')->with('message','Berhasil Hapus Tagihan');
    }

    public function cetakLaporanTagihan(Request $request)
    {
        $fileName    = 'Laporan Tagihan '.human_date($request->from).' - '.human_date($request->to).'.xlsx';
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $spreadsheet->getDefaultStyle()->getFont()->setSize('12');

        $spreadsheet->getActiveSheet()->setCellValue('B2','Laporan Tagihan');
        $spreadsheet->getActiveSheet()->setCellValue('B3',human_date($request->from).' - '.human_date($request->to));

        $spreadsheet->getActiveSheet()->setCellValue('B5','No.');
        $spreadsheet->getActiveSheet()->setCellValue('C5','Nama Customer');
        $spreadsheet->getActiveSheet()->setCellValue('D5','Tanggal Tagihan');
        $spreadsheet->getActiveSheet()->setCellValue('E5','Item Jual');
        $spreadsheet->getActiveSheet()->setCellValue('F5','Banyak Pesan');
        $spreadsheet->getActiveSheet()->setCellValue('G5','Varian');
        $spreadsheet->getActiveSheet()->setCellValue('H5','Sub Total');
        $spreadsheet->getActiveSheet()->setCellValue('I5','Keterangan Sub Tagihan');
        $spreadsheet->getActiveSheet()->setCellValue('J5','Status Sub Tagihan');
        $spreadsheet->getActiveSheet()->setCellValue('K5','Total Tagihan');
        $spreadsheet->getActiveSheet()->setCellValue('L5','Keterangan Tagihan');
        $spreadsheet->getActiveSheet()->setCellValue('M5','Input By');

        $tagihan = Tagihan::join('users','tagihan.id_users','=','users.id_users')
                                ->get();
        $sheet_cell   = 5;
        $sheet_tagihan = 5;

        foreach ($tagihan as $key => $value) {
            $sheet_cell = $sheet_cell+1;

            $spreadsheet->getActiveSheet()->setCellValue('B'.$sheet_cell,$key+1);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$sheet_cell,$value->nama_customer);

            $tagihan_detail = TagihanDetail::join('item_jual','tagihan_detail.id_item_jual','=','item_jual.id_item_jual')
                                                    ->where('id_tagihan',$value->id_tagihan)
                                                    ->whereBetween('tgl_tagihan',[$request->from,$request->to])
                                                    ->get();
            // dd($tagihan_detail);

            foreach ($tagihan_detail as $data) {
                $sheet_tagihan = $sheet_tagihan+1;

                $spreadsheet->getActiveSheet()->setCellValue('D'.$sheet_tagihan,human_date($data->tgl_tagihan));
                $spreadsheet->getActiveSheet()->setCellValue('E'.$sheet_tagihan,$data->nama_item);
                $spreadsheet->getActiveSheet()->setCellValue('F'.$sheet_tagihan,$data->banyak_pesan);
                $spreadsheet->getActiveSheet()->setCellValue('G'.$sheet_tagihan,$data->varian);
                $spreadsheet->getActiveSheet()->setCellValue('H'.$sheet_tagihan,format_rupiah($data->sub_total));
                $spreadsheet->getActiveSheet()->setCellValue('I'.$sheet_tagihan,$data->keterangan);
                $spreadsheet->getActiveSheet()->setCellValue('J'.$sheet_tagihan,unslug_str($data->status_tagihan_detail));
            }
            
            $spreadsheet->getActiveSheet()->setCellValue('K'.$sheet_cell,format_rupiah($value->total_tagihan));
            $spreadsheet->getActiveSheet()->setCellValue('L'.$sheet_cell,unslug_str($value->status_tagihan));
            $spreadsheet->getActiveSheet()->setCellValue('M'.$sheet_cell,$value->name);

            $spreadsheet->getActiveSheet()->mergeCells('B'.$sheet_cell.':B'.$sheet_tagihan);
            $spreadsheet->getActiveSheet()->mergeCells('C'.$sheet_cell.':C'.$sheet_tagihan);
            $spreadsheet->getActiveSheet()->mergeCells('K'.$sheet_cell.':K'.$sheet_tagihan);
            $spreadsheet->getActiveSheet()->mergeCells('L'.$sheet_cell.':L'.$sheet_tagihan);
            $spreadsheet->getActiveSheet()->mergeCells('M'.$sheet_cell.':M'.$sheet_tagihan);

            $sheet_cell = $sheet_tagihan;
        }

        $spreadsheet->getActiveSheet()->mergeCells('B2:M2');
        $spreadsheet->getActiveSheet()->mergeCells('B3:M3');

        $style_sheet = ['alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]];
        $styleTable = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];

        $spreadsheet->getActiveSheet()->getStyle('B2:M'.$sheet_cell)->applyFromArray($style_sheet);
        $spreadsheet->getActiveSheet()->getStyle('B5:M'.$sheet_cell)->applyFromArray($styleTable);
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
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(10);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        // $writer->setIncludeCharts(true);
        $writer->save('php://output');
    }
}
