<?php

namespace App\Exports;

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

class Planning_agent implements FromCollection, ShouldAutoSize, WithEvents, WithDrawings, WithHeadings
{
    private $planning_agent;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($request){

        if (isset($request->idAgent) && ! isset($request->idSite) && ! isset($request->idMois)) {

            $this->planning_agent = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->where('date_debut', '>=', Carbon::today())
            ->where('agent_id', $request->idAgent)
            ->groupBy('agent_id')
            ->get();

        }
        elseif (isset($request->idAgent) && isset($request->idSite) && ! isset($request->idMois)) {

            $this->planning_agent = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
            ->where('agent_id', $request->idAgent)
            ->where('site_id', $request->idSite)
            ->groupBy('agent_id')
            ->get();

        }
        elseif (isset($request->idAgent) && isset($request->idSite) && isset($request->idMois)) {

            $this->planning_agent = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
            ->where('agent_id', $request->idAgent)
            ->where('site_id', $request->idSite)
            ->groupBy('agent_id')
            ->get();

        }
        elseif (isset($request->idAgent) && ! isset($request->idSite) && isset($request->idMois)) {

            $this->planning_agent = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
            ->where('agent_id', $request->idAgent)
            ->groupBy('agent_id')
            ->get();

        }
        elseif (! isset($request->idAgent) && isset($request->idSite) && ! isset($request->idMois)) {

            $this->planning_agent = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->where('date_debut', '>=', Carbon::today())
            ->where('site_id', $request->idSite)
            ->groupBy('agent_id')
            ->get();

        }
        elseif (! isset($request->idAgent) && isset($request->idSite) && isset($request->idMois)) {

            $this->planning_agent = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
            ->where('site_id', $request->idSite)
            ->groupBy('agent_id')
            ->get();

        }
        elseif (! isset($request->idAgent) && ! isset($request->idSite) && isset($request->idMois)) {

            $this->planning_agent = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->whereYear('date_debut', '=', Carbon::today()->year)
            ->whereMonth('date_debut', '=', Carbon::parse($request->idMois)->month)
            ->groupBy('agent_id')
            ->get();

        }
        elseif (! isset($request->idAgent) && ! isset($request->idSite) && ! isset($request->idMois)) {
            
            $this->planning_agent = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
            ->where('date_debut', '>=', Carbon::today())
            ->groupBy('agent_id')
            ->get();

        }

    }

    public function collection()
    {
        // $title = array('N°', 'QUALIFICATION', 'NOM & PRÉNOMS', 'HEURES TOTAL JOUR', 'HEURES TOTAL NUIT');

        // $donneeExcel[] = array('N°', 'NOM & PRÉNOMS', 'QUALIFICATION', 'HEURES TOTAL JOUR', 'HEURES TOTAL NUIT');
        $donneeExcel = [];
        // $this->planning_agent = Planning::select(DB::raw('agent_id, sum(heure_total_jour) as heure_total_jour, sum(heure_total_nuit) as heure_total_nuit'))
        //                         ->where('statut','definitif')
        //                         ->where('date_debut', '>=', Carbon::now()->firstOfMonth())
        //                         ->where('date_debut', '<=', Carbon::now()->lastOfMonth())
        //                         ->groupBy('agent_id')
        //                         ->get();
        foreach ($this->planning_agent as $key => $planning)
        {

            $donneeExcel[] = array(
                'N°' => $key+1,
                'NOM & PRÉNOMS'     => $planning->agent->nom.' '.$planning->agent->prenoms ,
                'QUALIFICATION'     => $planning->agent->qualification,
                'HEURES TOTAL JOUR' => $planning->heure_total_jour + $planning->heure_total_nuit,
                'HEURES TOTAL NUIT' => $planning->heure_total_nuit
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

                $cellRange = 'A1:E' . ( $this->planning_agent->count() + 5 );

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
        return array('N°', 'Nom & Prénoms', 'Qualification', 'Heures Total', 'Heures de Nuit');
    }
    
}
