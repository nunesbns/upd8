<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Services\ApiBrasilService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info("Obtendo cidades da API Brasil");
        $this->seedCities();

        $this->command->info("Criando clientes no banco de dados");
        Client::factory(1000)->create();
    }

    private function seedCities()
    {
        $apiBrasilService = new ApiBrasilService();
        $states = $apiBrasilService->getCities();

        foreach ($states as $state) {
            $state_id = DB::table('states')->insertGetId([
                'name' => $state['nome'],
                'acronym' => $state['sigla'],
            ]);

            foreach ($state['cities'] as $city) {
                $this->command->info("Salvando " . $city['nome'] . ' - ' . $state['sigla']);
                DB::table('cities')->insert([
                    'name' => $city['nome'],
                    'ibge_code' => $city['codigo_ibge'],
                    'state_id' => $state_id,
                ]);
            }
        }
    }
}
