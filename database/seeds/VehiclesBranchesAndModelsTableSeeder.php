<?php

use Illuminate\Database\Seeder;

class VehiclesBranchesAndModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonMarcasCarro = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/base_veiculos/master/marcas_carro.json"));
        $marcasCarros = [];
        foreach ($jsonMarcasCarro as $marcaCarro) {
            $marcasCarros[$marcaCarro->ID] = \App\VehicleBranch::create([
                'name' => $marcaCarro->NOME,
                'type' => 0
            ]);
        }

        $jsonModeloCarros = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/base_veiculos/master/modelos_carro.json"));
        foreach ($jsonModeloCarros as $modeloCarro) {
            try {
                \App\VehicleModel::create([
                    'name' => $modeloCarro->NOME,
                    'branch_id' => $marcasCarros[$modeloCarro->IDMARCA]->id
                ]);
            } catch(Exception $e) {

            }
        }

        $jsonMarcasMoto = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/base_veiculos/master/marcas_moto.json"));
        $marcasMotos = [];
        foreach ($jsonMarcasMoto as $marcaMoto) {
            $marcasMotos[$marcaMoto->ID] = \App\VehicleBranch::create([
                'name' => $marcaMoto->NOME,
                'type' => 1
            ]);
        }

        $jsonModeloMotos = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/base_veiculos/master/modelos_moto.json"));
        foreach ($jsonModeloMotos as $modeloMoto) {
            try {
                \App\VehicleModel::create([
                    'name' => $modeloMoto->NOME,
                    'branch_id' => $marcasMotos[$modeloMoto->IDMARCA]->id
                ]);
            } catch(Exception $e) {

            }
        }

        $jsonMarcasNautica = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/base_veiculos/master/marcas_nautica.json"));
        $marcasNauticas = [];
        foreach ($jsonMarcasNautica as $marcaNautica) {
            $marcasNauticas[$marcaNautica->ID] = \App\VehicleBranch::create([
                'name' => $marcaNautica->NOME,
                'type' => 2
            ]);
        }

        $jsonModeloNauticas = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/base_veiculos/master/modelos_nautica.json"));
        foreach ($jsonModeloNauticas as $modeloNautica) {
            try {
                \App\VehicleModel::create([
                    'name' => $modeloNautica->NOME,
                    'branch_id' => $marcasNauticas[$modeloNautica->IDMARCA]->id
                ]);
            } catch(Exception $e) {

            }
        }

        $jsonMarcasCaminhoes = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/base_veiculos/master/marcas_caminhao.json"));
        $marcasCaminhoes = [];
        foreach ($jsonMarcasCaminhoes as $marcaCaminhao) {
            $marcasCaminhoes[$marcaCaminhao->ID] = \App\VehicleBranch::create([
                'name' => $marcaCaminhao->NOME,
                'type' => 3
            ]);
        }

        $jsonModeloCaminhoes = json_decode(file_get_contents("https://raw.githubusercontent.com/guifabrin/base_veiculos/master/modelos_caminhao.json"));
        foreach ($jsonModeloCaminhoes as $modeloCaminhao) {
            try {
                \App\VehicleModel::create([
                    'name' => $modeloCaminhao->NOME,
                    'branch_id' => $marcasCaminhoes[$modeloCaminhao->IDMARCA]->id
                ]);
            } catch(Exception $e) {

            }
        }
    }
}
