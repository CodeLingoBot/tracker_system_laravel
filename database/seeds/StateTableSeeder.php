<?php

use App\City;
use App\State;
use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonEstados = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/postmon_cep/master/estado.json"));
        $states = [];
        foreach ($jsonEstados as $estados) {
            $states[$estados->id] = State::create([
                'name' => $estados->nome,
                'initials' => $estados->sigla,
            ]);
        }
        $jsonCidade = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/postmon_cep/master/cidade.json"));
        foreach ($jsonCidade as $cidade) {
            City::create([
                'name' => $cidade->nome,
                'state_id' => $states[$cidade->estado_id]->id,
            ]);
        }
    }
}
