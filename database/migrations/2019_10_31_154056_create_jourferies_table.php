<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourferiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jourferies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dateferie',5);
            $table->string('description');
            $table->date('dateincal');
            $table->timestamps();
        });

        $data=[
            0=>[
                'dateferie'=>'01-01',
                'description'=>'Jour de l\'An',
                'dateincal'=>"2020-01-01"
            ],
            1=>[
                'dateferie'=>'04-02',
                'description'=>'Pâcque',
                'dateincal'=>"2020-04-02"
            ],
            2=>[
                'dateferie'=>'05-01',
                'description'=>'Fête du Travail',
                'dateincal'=>"2020-05-01"
            ],
            3=>[
                'dateferie'=>'05-08',
                'description'=>'Victoire 1945',
                'dateincal'=>"2020-05-08"
            ],
            4=>[
                'dateferie'=>'05-10',
                'description'=>'Ascension',
                'dateincal'=>"2020-05-10"
            ],
            5=>[
                'dateferie'=>'05-21',
                'description'=>'Pentecôte',
                'dateincal'=>"2020-05-21"
            ],
            6=>[
                'dateferie'=>'07-14',
                'description'=>'Fête nationale',
                'dateincal'=>"2020-07-14"
            ],
            7=>[
                'dateferie'=>'08-15',
                'description'=>'Assomption',
                'dateincal'=>"2020-08-15"
            ],
            8=>[
                'dateferie'=>'11-01',
                'description'=>'Toussaint',
                'dateincal'=>"2020-11-01"
            ],
            9=>[
                'dateferie'=>'11-11',
                'description'=>'Armistice 1918',
                'dateincal'=>"2020-11-11"
            ],
            10=>[
                'dateferie'=>'11-25',
                'description'=>'Noël',
                'dateincal'=>"2020-11-25"
            ],
        ];

        DB::table('jourferies')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jourferies');
    }
}
