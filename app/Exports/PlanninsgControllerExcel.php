<?php

namespace App\Exports;

use App\Helpers\BlackshFonctions;
use App\Models\Planning;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// class Planning_agent implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents

class PlanninsgControllerExcel implements FromCollection, ShouldAutoSize, WithEvents, WithDrawings, WithHeadings
{
    private $planning_agents;
    /**
    * @return \Illuminate\Support\Collection
    */



    public function __construct($type)
    {
        $this->planning_agents  = \Illuminate\Support\Facades\DB::table('plannings')
            ->select('agents.id as id', 'vacation_id', 'plannings.created_at',
                DB::RAW("agents.nom as agentnom"),
                DB::RAW("agents.prenoms as agentprenoms"),
                DB::RAW("sites.nom as sitenom"),
                DB::RAW("agents.prenoms as agentprenom"),
                DB::raw("SUM(heure_total_jour) as heure_total_jour"),
                DB::raw("SUM(heure_total_nuit) as heure_total_nuit"),
                DB::raw("SUM(heures_total) as heures_total"),
                DB::raw("SUM(minutes) as minutes"), 'statut',
                DB::raw("SUM(minutes_jour) as minutes_jour"),
                DB::raw("SUM(minutes_nuit) as minutes_nuit"),
                DB::raw("MAX(plannings.created_at) as latest_date"))
            ->where('statut', $type)
            ->join('agents', 'agents.id', '=', 'plannings.agent_id')
            ->join('sites', 'sites.id' , '=', 'plannings.site_id')
            ->groupBy('agent_id')
            //->groupBy('vacation_id')
            ->orderBy('latest_date', 'desc')
            ->get();
    }

    public function collection()
    {
      
        $donneeExcel = [];
       
        foreach ($this->planning_agents as $key => $planning)
        {
            $total = $planning->heures_total ;

            $total = $total + intval(($planning->minutes / 60));
            $minutes = intval($planning->minutes/60) > 0 ?   intval($planning->minutes% 60 ): (int)$planning->minutes ;


            $total = $total + (int)($minutes / 60) ;
            $minutes = (int)($minutes % 60) ;

            $heures_total_hours = $planning->heure_total_jour + intval(($planning->minutes_jour / 60));
            $minutes_jours = intval($planning->minutes_jour) > 0 ?   intval($planning->minutes_jour% 60 ): (int)$planning->minutes_jour ;

            $heure_total_nuit = $planning->heure_total_nuit + intval(($planning->minutes_nuit / 60));
            $minutes_nuit =  intval($planning->minutes_nuit/60) > 0 ? intval($planning->minutes_nuit%60) : (int)$planning->minutes_nuit ;

                $donneeExcel[] = array(
                'NOM & PRÉNOMS'     => $planning->agentnom.' '.$planning->agentprenoms ,
                'TOTAL HEURES JOUR' => BlackshFonctions::format($heures_total_hours.':'.$minutes_jours.':'.'00') ,
                'TOTAL HEURES NUIT' => BlackshFonctions::format($heure_total_nuit.':'.$minutes_nuit.':'.'00') ,
                'TOTAL DES HEURES' => BlackshFonctions::format($total.':'.$minutes.':'.'00') ,
                'SITE' => $planning->sitenom
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
        $drawing->setOffsetX(-50);
        $drawing->setOffsetY(-190);
        $drawing->setCoordinates('D1');

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $cellRange = 'A1:E' . ( $this->planning_agents->count() + 5 );

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11.5);
                $event->getSheet()->getDelegate()->getStyle('A5:E5')->applyFromArray([
                    'size' => '12',
                    'font' => [
                        'bold' => true,
                    ],
                ]);

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

                $event->sheet->mergeCells(sprintf('A5:E5'));
                $event->sheet->mergeCells(sprintf('A6:E6'));
                $event->sheet->mergeCells(sprintf('A7:E7'));
                $event->sheet->mergeCells(sprintf('A9:E9'));

                $event->sheet->setCellValue('A5','BLACK SHIELD SECURITE');
                $event->sheet->setCellValue('A6','La Protection et la Sécurité, notre métier');
                $event->sheet->setCellValue(sprintf('A7'),'Tel : 01 41 38 68 11');
                $event->sheet->setCellValue(sprintf('A7'),'Tel : 01 41 38 68 11');
                $event->sheet->setCellValue(sprintf('A9'),'Paris le '. ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD MMMM YYYY')));

                $event->sheet->getStyle('A5')->applyFromArray([
                    'size' => '12',
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A11:E11')->applyFromArray([
                    'size' => '12',
                    'color' => ['argb' => '000000'],
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => '000000'],

                    ],
                ]);
                $event->sheet->getStyle('A5:A9')->applyFromArray($style_text_center);
                $event->sheet->getDelegate()->getStyle('A11:E11')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('2c2f26');
                $event->sheet->getDelegate()->getStyle('A11:E11')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            },
        ];
        // return $tableau;
    }
    
    public function headings(): array
    {
        return array(   'Nom & Prénoms', 'Total Heures Jour ', 'Total Heures Nuit' , 'Total des heures' , 'Sites');
    }
    
}
