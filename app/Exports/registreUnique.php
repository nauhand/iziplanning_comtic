<?php

namespace App\Exports;

use App\Models\Agent;
use App\Models\Planning;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class registreUnique implements FromCollection, ShouldAutoSize, WithEvents, WithDrawings, WithHeadings
{
    public $agents;
    
    public function __construct() 
    {
        $this->agents = Agent::select(DB::raw('*'))
                        ->orderBy('nom', 'asc')
                        ->get();
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        foreach ($this->agents as $key => $agent)
        {

            $donneeExcel[] = array(
                'N°'                            => $key+1,
                'NOM & PRÉNOMS'                 => $agent->nom.' '.$agent->prenoms,
                'DATE NAISS.'                   => $agent->datenaissance,
                'MATRICULE'                     => $agent->matricule,
                'EMAIL'                         => $agent->email,
                'DÉPARTEMENT'                   => $agent->departement->nom ?? '',
                'NATIONALITÉ'                   => $agent->nationalite,
                'VILLE'                         => $agent->ville,
                'QUALIFICATION'                 => $agent->qualification,
                'STATUT MATRIMONIAL'            => $agent->statutmatrimonial,
                'ADRESSE GÉOGRAPHIQUE'          => $agent->adressegeo,
                'CONTACT'                       => strval($agent->numeromobile),
                'CODE POSTAL'                   => $agent->codepostal,
                'N° FIXE'                       => strval($agent->numerofixe),
                'N° CNI'                        => strval($agent->numerocni),
                'TYPE DE TITRE DE SEJOUR'       => $agent->typesejour,
                'N° ETRANGER'                   => strval($agent->numeroetranger),
                'LIEU DE DELIVRANCE'            => $agent->lieudelivrancecs,
                'DATE D\'ETABLISSEMENT'         => $agent->etablissementcartedesejour,
                'DATE D\'EXPIRATION'            => $agent->expirationcartedesejour,
                'N° SECURITE SOCIALE'           => $agent->numerosecuritesocial,
                //'N° CAF'                        => $agent->caf,
                'N°PERMIS DE CONDUIRE'          => $agent->numeropermis,
                'DATE D\'ETABLISSEMENT PERMIS'  => $agent->dateetablpermis,
                'DATE D\'EXPIRATION PERMIS'     => $agent->dateexpirpermis,
                'CATEGORIES PERMIS'             => $agent->categoriepermis,
                'TYPE DE CONTRAT'               => $agent->typecontrat,
                'DATE D\'ENTRÉE'                => $agent->dateentree,
                //'N°ADS'                         => $agent->numeroads,
                'DATE LIMITE CARTE PROFESSIONNELLE' => $agent->datelimitecartepro,
                'NOM DU CHIEN'                  => $agent->nomchien,
                'DATE DE  VALIDITE VACCIN'      => $agent->datevaliditevaccin
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
        $drawing->setOffsetX(150);
        $drawing->setOffsetY(-190);
        $drawing->setCoordinates('Q1');

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $cellRange = 'A1:AF' . ( $this->agents->count() + 5 );

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11.5);
                
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

                $event->sheet->mergeCells(sprintf('A5:AF5'));
                $event->sheet->mergeCells(sprintf('A6:AF6'));
                $event->sheet->mergeCells(sprintf('A7:AF7'));
                $event->sheet->mergeCells(sprintf('A9:AF9'));

                // $event->sheet->mergeCells(sprintf('G1:H1'));
                // $event->sheet->mergeCells(sprintf('G2:H2'));
                // $event->sheet->mergeCells(sprintf('G3:H3'));
                $event->sheet->mergeCells(sprintf('G8:AF8'));

                // $event->sheet->setCellValue('G1','Nom : '. $this->agents->nom .' '. $this->agents->prenoms);
                // $event->sheet->setCellValue('G2','Matricule : '. $this->agents->matricule);
                // $event->sheet->setCellValue('G3','N° Sécurité sociale : '. $this->agents[0]->agent->numeross);
                
                $event->sheet->setCellValue('A5','BLACK SHIELD SECURITE');
                $event->sheet->setCellValue('A6','La Protection et la Sécurité, notre métier');
                $event->sheet->setCellValue(sprintf('A7'),'Tel : 01 41 38 68 11');
                $event->sheet->setCellValue(sprintf('A7'),'Tel : 01 41 38 68 11');
                $event->sheet->setCellValue(sprintf('G8'),'Paris le '. ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD MMMM YYYY')));
                $event->sheet->setCellValue(sprintf('A9'),'REGISTRE UNIQUE DU PERSONNEL');

                $event->sheet->getStyle('A5')->applyFromArray([
                    'size' => '12',
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A11:AF11')->applyFromArray([
                    'size' => '12',
                    'color' => ['argb' => '000000'],
                    'font' => [

                        'bold' => true,
                        'color' => ['argb' => '000000'],

                    ],
                ]);
                $event->sheet->getStyle('A5:A9')->applyFromArray($style_text_center);
                $event->sheet->getStyle('G8')->applyFromArray($style_text_right);
                $event->sheet->getStyle('A9')->applyFromArray([
                    'size' => '16',
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                $event->sheet->getDelegate()->getStyle('A11:AF11')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('2c2f26');
                $event->sheet->getDelegate()->getStyle('A11:AF11')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            },
        ];
        // return $tableau;
    }
    
    public function headings(): array
    {

        return array(
            'N°',
            'NOM & PRÉNOMS',
            'DATE NAISS.',
            'MATRICULE',
            'EMAIL',
            'DÉPARTEMENT',
            'NATIONALITÉ',
            'VILLE',
            'QUALIFICATION',
            'STATUT MATRIMONIAL',
            'ADRESSE GÉOGRAPHIQUE',
            'CONTACT',
            'CODE POSTAL',
            'N° FIXE',
            'N° CNI',
            'TYPE DE TITRE DE SEJOUR',
            'N° ETRANGER',
            'LIEU DE DELIVRANCE',
            'DATE D\'ETABLISSEMENT',
            'DATE D\'EXPIRATION',
            'N° SECURITE SOCIALE',
            //'N° CAF',
            'N°PERMIS DE CONDUIRE',
            'DATE D\'ETABLISSEMENT PERMIS',
            'DATE D\'EXPIRATION PERMIS',
            'CATEGORIES PERMIS',
            'TYPE DE CONTRAT',
            'DATE D\'ENTRÉE',
            //'N°ADS',
            'DATE LIMITE CARTE PROFESSIONNELLE',
            'NOM DU CHIEN',
            'DATE DE  VALIDITE VACCIN'
        );
    }
    
}

