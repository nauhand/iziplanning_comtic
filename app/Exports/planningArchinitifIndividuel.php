<?php

namespace App\Exports;

use App\Models\Planning;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Illuminate\Support\Carbon;
use App\Models\Agent;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Symfony\Component\HttpFoundation\Request;

class planningArchinitifIndividuel implements FromCollection, ShouldAutoSize, WithEvents, WithDrawings, WithHeadings
{
    // private $agent;
    private $plannings;


    public function __construct($ID) 
    {
            list($id , $data , $vaccation ) = explode('-',$ID);

            $this->plannings = Planning::select(DB::raw('*'))
                        ->where('agent_id', $id)
                        ->where('vacation_id', $vaccation)
                        ->where('statut', 'archives')
                        ->orderBy('date_debut', 'asc')
                        ->get();

    //    return view('pages.plannings.vacations-provisoire', compact('agent', 'plannings', 'sites'));
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        // $plannings = Planning::select(DB::raw('*'))
        //             ->where('agent_id', $this->agent->id)
        //             ->where('statut','definitif')
        //             ->where('date_debut', '>=',Carbon::now())
        //             ->orderBy('date_debut', 'asc')
        //             ->get();

        // $donneeExcel[] = array('DATE', 'SITE', 'QUALIFICATION', 'DÉBUT SERVICE', 'FIN SERVICE', 'HEURES PAUSE', 'HEURES DE NUIT', 'TOTAL HEURES');
        foreach ($this->plannings as $key => $planning)
        {

            $donneeExcel[] = array(
                'CRÉE LE'          => ucfirst(\Carbon\Carbon::parse($planning->created_at)->locale('fr_FR')->isoFormat('dddd  DD')),
                'DATE'          => ucfirst(\Carbon\Carbon::parse($planning->date_debut)->locale('fr_FR')->isoFormat('dddd  DD')),
                'SITE'          => $planning->site->nom,
                'DÉBUT SERVICE' => $planning->heure_debut,
                'FIN SERVICE'   => $planning->heure_fin,
                'HEURES PAUSE'  => $planning->pause,
                'HEURES DE NUIT'=> $planning->heure_total_nuit,
                'TOTAL HEURES'  => $planning->heure_total_jour + $planning->heure_total_nuit
            );
        }
                
        return collect($donneeExcel);

    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Black Shield Securite');
        // $drawing->setPath(public_path('blacksecuritylogo2.jpg'));
        $drawing->setPath(public_path('../uploads/blacksecuritylogo2.jpg'));

        $drawing->setHeight(70);
        $drawing->setOffsetX(50);
        $drawing->setOffsetY(-190);
        $drawing->setCoordinates('B1');

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $cellRange = 'A1:H' . ( $this->plannings->count() + 5 );

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11.5);
                // $event->getSheet()->getDelegate()->getStyle('A5:H5')->applyFromArray([
                //     'size' => '12',
                //     'font' => [
                //         'bold' => true,
                //     ],
                // ]);

                $event->getSheet()->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                $style_text_center = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ];

                $style_text_right = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_RIGHT
                    ]
                ];
                // at row 1, insert 2 rows
                $event->sheet->insertNewRowBefore(1, 10);

                $event->sheet->mergeCells(sprintf('A5:C5'));
                $event->sheet->mergeCells(sprintf('A6:C6'));
                $event->sheet->mergeCells(sprintf('A7:C7'));
                $event->sheet->mergeCells(sprintf('A9:H9'));

                $event->sheet->mergeCells(sprintf('G1:H1'));
                $event->sheet->mergeCells(sprintf('G2:H2'));
                $event->sheet->mergeCells(sprintf('G3:H3'));
                $event->sheet->mergeCells(sprintf('G6:H6'));

                $event->sheet->setCellValue('G1','Nom : '. $this->plannings[0]->agent->nom .' '. $this->plannings[0]->agent->prenoms);
                $event->sheet->setCellValue('G2','Matricule : '. $this->plannings[0]->agent->matricule);
                $event->sheet->setCellValue('G3','N° Sécurité sociale : '. $this->plannings[0]->agent->numeross);

                // foreach ($plannings as $value) {
            
                //     foreach ($joursFerie as $jour) {
                        
                //         if ( Carbon::parse($value->date_debut)->format("m d") === Carbon::parse($jour)->format("m d") ) {
                //             $heureFerieJour += $value->heure_total_jour;
                //             $heureFerieNuit += $value->heure_total_nuit;
                //         }
                //     }
                    
                // }

                // $event->sheet->setCellValue('G3','Heure Total : '. $this->planning_agent[0]->agent->numeross);
                // $event->sheet->setCellValue('G3','Heure Total Nuit : '. $this->planning_agent[0]->agent->numeross);
                // $event->sheet->setCellValue('G3','Heure Total Férié : '. $this->planning_agent[0]->agent->numeross);
                // Nom : $plannings[0]->agent->nom .' '. $plannings[0]->agent->prenoms  
                //     <b>Matricule : </b> {{ $plannings[0]->agent->matricule }} <br>
                //     <b>N° Sécurité sociale :</b> {{ $plannings[0]->agent->numeross }} <br>
                //     <b>Base mensuelle : </b> <br>


                $event->sheet->setCellValue('A5','BLACK SHIELD SECURITE');
                $event->sheet->setCellValue('A6','La Protection et la Sécurité, notre métier');
                $event->sheet->setCellValue(sprintf('A7'),'Tel : 01 41 38 68 11');
                $event->sheet->setCellValue(sprintf('A7'),'Tel : 01 41 38 68 11');
                $event->sheet->setCellValue(sprintf('G6'),'Paris le '. ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD MMMM YYYY')));
                $event->sheet->setCellValue(sprintf('A9'),'PLANNING   DE '. $this->plannings[0]->agent->nom .' '. $this->plannings[0]->agent->prenoms);
                

                $event->sheet->getStyle('A5')->applyFromArray([
                    'size' => '12',
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A11:H11')->applyFromArray([
                    'size' => '12',
                    'color' => ['argb' => '000000'],
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => '000000'],

                    ],
                ]);
                $event->sheet->getStyle('A5:A9')->applyFromArray($style_text_center);
                $event->sheet->getStyle('G6')->applyFromArray($style_text_right);
                $event->sheet->getStyle('A9')->applyFromArray([
                    'size' => '16',
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                $event->sheet->getDelegate()->getStyle('A11:H11')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('2c2f26');
                $event->sheet->getDelegate()->getStyle('A11:H11')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            },
        ];
        // return $tableau;
    }
    
    public function headings(): array
    {
        return array('CRÉE LE','DATE', 'SITE', 'DÉBUT SERVICE', 'FIN SERVICE', 'HEURES PAUSE', 'HEURES DE NUIT', 'TOTAL HEURES');
    }
    
}
