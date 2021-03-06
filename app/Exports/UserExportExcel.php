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
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
class UserExportExcel implements FromCollection, ShouldAutoSize, WithEvents, WithDrawings, WithHeadings
{
    // private $agent;
    private $users;
    public function __construct()
    {
        $this->users = DB::table('users')
        ->select('*')
        ->where('id','!=',Auth::user()->id)
        ->get();
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
        foreach ($this->users as $key => $user)
        {
            $donneeExcel[] = array(
                // 'DATE'           => ucfirst(\Carbon\Carbon::parse($planning->date_debut)->locale('fr_FR')->isoFormat('dddd  DD')),
                'NOM ET PRENOMS' => $user->nom . ' ' . $user->prenoms ,
                'CONTACT DE L\'UTILISATEUR' => $user->numeromobile,
                'ADRESSE EMAIL'   => $user->email ,
                'TYPE DE COMPTE'=>  $user->is_admin ? 'ADMINISTRATEUR' : 'ÉDITEUR'  ,
                'ETAT DU COMPTE'=>  $user->is_active ? 'ACTIF' : 'INACTIF'  ,
                'DATE DE CREATION' => $user->created_at,
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
                $cellRange = 'A1:H' . ( $this->users->count() + 5 );
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
                // $event->sheet->setCellValue('G1','Nom : '. $this->planning_agent[0]->agent->nom .' '. $this->planning_agent[0]->agent->prenoms);
                // $event->sheet->setCellValue('G2','Matricule : '. $this->planning_agent[0]->agent->matricule);
                // $event->sheet->setCellValue('G3','N° Sécurité sociale : '. $this->planning_agent[0]->agent->numeross);
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
                $event->sheet->setCellValue(sprintf('A9'),'PLANNING "DÉFINITIF" DU MOIS DE '. strtoupper(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('MMMM')));
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
             return  Array(
                'NOM ET PRENOMS' ,
                'CONTACT DE L\'UTILISATEUR' ,
                'ADRESSE EMAIL' ,
                'TYPE DE COMPTE'        ,
                'ETAT DU COMPTE' ,
                'DATE DE CREATION',
             );
    }
}

?>