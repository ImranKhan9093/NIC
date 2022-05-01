<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CMExport implements WithHeadings,WithEvents,WithStyles,FromCollection,WithCustomStartCell
{
   private $headings1='Financial year ';
   private $headings2='Reporting month';
   private $headings3='Name of the district Jalpaiguri';
    public function headings(): array
    { 

        return [

            // [$this->headings1],
            // [$this->headings2],
            // [$this->headings3],

        ];
    }
    public function startCell(): string
    {
        return 'A9';
    }
    
    public function collection()
    {

       $excelData=DB::table('block_muni')
                ->select('block_muni.blockmuni', 
                        'kishan_credit_card.KCC_target', 
                        'kishan_credit_card.KCC_sponsored', 
                        'kishan_credit_card.KCC_sanctioned', 
                        'kishan_credit_card.Percentage_sponsored',
                        'kishan_mandi.KM_operational',
                        'mgnregs.tot_person_days_generate', 
                        'mgnregs.avg_persondays_per_household', 
                        'mgnregs.expenditure_made_under_mgnrega',
                        'mgnregs.percentage_of_labour_budget_achieved',
                        'anandadhara.tot_SHGs_formed', 
                        'anandadhara.tot_SHGs_credit_linkage')
                ->leftJoin('kishan_credit_card','block_muni.blockminicd','=','kishan_credit_card.blockminicd')
                ->leftJoin('kishan_mandi','block_muni.blockminicd','=','kishan_mandi.blockminicd')
                ->leftJoin('mgnregs','block_muni.blockminicd','=','mgnregs.blockminicd')
                ->leftJoin('anandadhara','block_muni.blockminicd','=','anandadhara.blockminicd')
                ->get();
         
        return  $excelData;              

    }

    // public function array():array
    // { 
        
    //     $currentMonth=date('n');
    //     //  dd(gettype($currentMonth));
       
    
    //     $kcc=DB::table('block_muni')
    //           ->select('block_muni.blockmuni', 'kishan_credit_card.KCC_target', 'kishan_credit_card.KCC_sponsored', 'kishan_credit_card.KCC_sanctioned', 'kishan_credit_card.Percentage_sponsored')
    //           ->leftJoin('kishan_credit_card','block_muni.blockminicd','=','kishan_credit_card.blockminicd')

    //           ->get();
    //     // dd($kcc);
    //     $km=DB::table('block_muni')
    //             ->select('block_muni.blockmuni','kishan_mandi.KM_operational')
                
    //             ->leftJoin('kishan_mandi','block_muni.blockminicd','=','kishan_mandi.blockminicd')
             
    //             ->get();
    //     // dd($km);        
    // $mgnregs=DB::table('block_muni')
    //         ->select('block_muni.blockmuni', 'mgnregs.tot_person_days_generate', 'mgnregs.KCC_sponsored', 'mgnregs.avg_persondays_per_household', 'mgnregs.percentage_of_labour_budget_achieved')
    //         ->leftJoin('mgnregs','block_muni.blockminicd','=','mgnregs.blockminicd')
           
    //         ->get();
    // //  dd($mgnregs);       
    // $anandadhara=DB::table('block_muni')
    //         ->select('block_muni.blockmuni','anandadhara.tot_SHGs_formed', 'anandadhara.tot_SHGs_credit_linkage')
            
    //         ->leftJoin('anandadhara','block_muni.blockminicd','=','anandadhara.blockminicd')
    //         ->get();
        
    // // dd($anandadhara);
    
    // // dd(['kcc'=>$kcc,'km'=>$km,'mgnregs'=>$mgnregs,'anandadhara'=>$anandadhara]);
    // $data=['Kishan Credit Card'=>$kcc,'Kishan Mandi'=>$km,'MGNREGS'=>$mgnregs,'Anandadhara'=>$anandadhara];
        
    // return [];
    //   return [$data]; 

    //    dd($data);
    //     // return $data;
       
   
    // }


    public function registerEvents(): array
    {
        return [
            
            AfterSheet::class=>function(AfterSheet $event ){

                //merging cells
                $event->sheet->getDelegate()->mergeCells('B5:E5');
                $event->sheet->getDelegate()->mergeCells('G5:J5');
                $event->sheet->getDelegate()->mergeCells('K5:L5');
                $event->sheet->getDelegate()->mergeCells('J9:J23');
                 
                //set headings
                $event->sheet->setCellValue('B1','Financial year');
                $event->sheet->setCellValue('B2','Reporting month');
                $event->sheet->setCellValue('B3','Name of the district-Jalpaiguri');
                //$event->sheet->setCellValue('J9',124);


                //assigning titles to cells
                $event->sheet->setCellValue('B5','Kishan Credit Card');
                $event->sheet->setCellValue('F5','Kishan Mandi');
                $event->sheet->setCellValue('G5','MGNREGS');
                $event->sheet->setCellValue('K5','Anandadhara');
                      
                //assigning headings for data
                $event->sheet->setCellValue('A7','Name of the block/Municipality');
                $event->sheet->setCellValue('B7','Target(New)');
                $event->sheet->setCellValue('C7','No. of KCC sponsored');
                $event->sheet->setCellValue('D7','No. of KCC sanctioned');
                $event->sheet->setCellValue('E7','KCC sponsored percentage');
                $event->sheet->setCellValue('F7','No. of Kishan Mandis sanctioned and no. of Kishan Mandis made operational.PI write FO=Fully Operational,PO=Partially Operational');
                $event->sheet->setCellValue('G7','Number of Person days generated under MGNREGA(2021-22)');
                $event->sheet->setCellValue('H7',' Average Number of Person days generated per  household(2021-22)');
                $event->sheet->setCellValue('I7','Expenditure made under MGNREGA(2021-22)');
                $event->sheet->setCellValue('J7','% of labour budget achieved so far (2021-22)');
                $event->sheet->setCellValue('K7','Total number of SHGs formed in the district ');
                $event->sheet->setCellValue('L7','Total number of SHGs got credit linkage ');
                

                //styling value given above to align center vertically and horizontally
                $cellRangeForTitles = 'A5:k5';
                $cellRangeForHeadingsOfData='A7:L7';
                $event->sheet->getDelegate()->getStyle($cellRangeForTitles)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRangeForHeadingsOfData)->getFont()->setSize(9);
                $event->sheet->getDelegate()->getStyle('A7:A20')->getFont()->setSize(9);
                $event->sheet->getDelegate()->getStyle('A7:A20')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('A7:A20')->getFont()->setBold(true);
                // $event->sheet->getDelegate()->getStyle($cellRangeForHeadingsOfData)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRangeForHeadingsOfData)->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle($cellRangeForTitles)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($cellRangeForHeadingsOfData)->getAlignment()->setVertical(Alignment::VERTICAL_TOP)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('J9')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // $event->sheet->getDelegate()->getStyle('B5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // $event->sheet->getDelegate()->getStyle('F5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // $event->sheet->getDelegate()->getStyle('G5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // $event->sheet->getDelegate()->getStyle('K5')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);

                  

                //Setting row height and column widths
                $event->sheet->getDelegate()->getRowDimension('5')->setRowHeight(40);
                $event->sheet->getDelegate()->getRowDimension('7')->setRowHeight(90);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(12);
               
                //freeze row
                $event->sheet->getDelegate()->freezePane('A8');
            }

        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
     
                1   => ['font' => ['bold' => true]],
                2   => ['font' => ['bold' => true]],
                3   => ['font' => ['bold' => true]],
                // 'A7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'B7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'C7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'D7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'E7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'F7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'G7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'H7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'I7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'J7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'K7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
                // 'L7' => ['alignment' => ['wrapText' => true],'font' => ['bold' => true],],
             

        ];
    }
}
