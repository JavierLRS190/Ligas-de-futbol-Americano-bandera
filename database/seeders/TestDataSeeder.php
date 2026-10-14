<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\League;
use App\Models\Team;
use App\Models\User;
use App\Models\Player;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestDataSeeder extends Seeder
{
    /**
     * Seed para generar datos de prueba completos
     * php artisan db:seed --class=TestDataSeeder
     */
    public function run()
    {
        $this->command->info('🏈 Generando datos de prueba para la liga...');

        // ============================================
        // 1. Crear Ligas de Prueba
        // ============================================
        $leagues = [
            [
                'name' => 'Liga Flag Football México',
                'short_name' => 'LFFM',
                'city' => 'Ciudad de México',
                'country' => 'México',
                'description' => 'Liga principal de fútbol bandera en México',
            ],
            [
                'name' => 'Liga Regional Puebla',
                'short_name' => 'LRP',
                'city' => 'Puebla',
                'country' => 'México',
                'description' => 'Liga regional de fútbol bandera',
            ],
        ];

        $createdLeagues = [];
        foreach ($leagues as $leagueData) {
            $league = League::firstOrCreate(
                ['name' => $leagueData['name']], // Buscar por nombre
                $leagueData // Si no existe, crear con estos datos
            );
            $createdLeagues[] = $league;
            $this->command->info("✓ Liga: {$league->name}");
        }

        // ============================================
        // 2. Crear Equipos con Entrenadores
        // ============================================
        $teamNames = [
            'Águilas', 'Tigres', 'Lobos', 'Panteras', 'Leones',
            'Halcones', 'Jaguares', 'Osos', 'Toros', 'Búfalos',
            'Tiburones', 'Delfines', 'Cóndores', 'Zorros', 'Pumas'
        ];

        $cities = ['CDMX', 'Puebla', 'Guadalajara', 'Monterrey', 'Querétaro'];

        foreach ($createdLeagues as $league) {
            // 8 equipos por liga
            for ($i = 0; $i < 8; $i++) {
                $teamName = $teamNames[$i] . ' ' . $league->city;
                
                // Verificar si el equipo ya existe
                $team = Team::firstOrCreate(
                    [
                        'name' => $teamName,
                        'league_id' => $league->id,
                    ],
                    [
                        'short_name' => strtoupper(substr($teamNames[$i], 0, 3)),
                        'city' => $cities[array_rand($cities)],
                        'stadium' => 'Estadio ' . $teamNames[$i],
                        'founded_year' => rand(2015, 2023),
                        'description' => 'Equipo profesional de fútbol bandera',
                    ]
                );

                // Crear entrenador solo si el equipo no tiene uno
                $coach = User::firstOrCreate(
                    [
                        'email' => Str::slug($teamName) . '@test.com',
                    ],
                    [
                        'name' => $this->generateName(),
                        'password' => Hash::make('password123'),
                        'role' => 'coach',
                        'team_id' => $team->id,
                        'league_id' => $league->id,
                        'is_active' => true,
                    ]
                );

                $this->command->info("  ✓ Equipo: {$team->name} (Entrenador: {$coach->name})");

                // ============================================
                // 3. Crear Jugadores para cada equipo
                // ============================================
                
                // Solo crear jugadores si el equipo tiene menos de 15
                $currentPlayers = Player::where('team_id', $team->id)->count();
                
                if ($currentPlayers < 15) {
                    $positions = ['QB', 'RB', 'WR', 'TE', 'OL', 'DL', 'LB', 'DB', 'K'];
                    
                    // Obtener números de jersey ya usados
                    $usedNumbers = Player::where('team_id', $team->id)->pluck('jersey_number')->toArray();
                    
                    for ($j = 1; $j <= 15; $j++) {
                        // Saltar si el número ya está usado
                        if (in_array($j, $usedNumbers)) {
                            continue;
                        }
                        
                        Player::create([
                            'team_id' => $team->id,
                            'first_name' => $this->generateFirstName(),
                            'last_name' => $this->generateLastName(),
                            'jersey_number' => $j,
                            'position' => $positions[array_rand($positions)],
                            'birth_date' => now()->subYears(rand(18, 35))->format('Y-m-d'),
                            'height' => rand(165, 195), // cm
                            'weight' => rand(65, 110), // kg
                        ]);
                    }
                }
            }
        }

        $this->command->info('');
        $this->command->info('✅ Datos generados exitosamente:');
        $this->command->info("   • {$createdLeagues->count()} ligas");
        $this->command->info("   • " . Team::count() . " equipos");
        $this->command->info("   • " . User::where('role', 'coach')->count() . " entrenadores");
        $this->command->info("   • " . Player::count() . " jugadores");
        $this->command->info('');
        $this->command->info('📧 Credenciales de entrenadores:');
        $this->command->info('   Email: nombre-equipo@test.com');
        $this->command->info('   Password: password123');
    }

    // ============================================
    // Helpers para generar nombres realistas
    // ============================================
    
    private function generateName()
    {
        return $this->generateFirstName() . ' ' . $this->generateLastName();
    }

    private function generateFirstName()
    {
        $nombres = [
            'Carlos', 'Miguel', 'José', 'Luis', 'Juan', 'Pedro', 
            'Antonio', 'Francisco', 'Javier', 'Rafael', 'Daniel',
            'Fernando', 'Ricardo', 'Roberto', 'Alejandro', 'Sergio',
            'Diego', 'Andrés', 'Mario', 'Oscar'
        ];
        return $nombres[array_rand($nombres)];
    }

    private function generateLastName()
    {
        $apellidos = [
            'García', 'Rodríguez', 'Martínez', 'López', 'González',
            'Hernández', 'Pérez', 'Sánchez', 'Ramírez', 'Torres',
            'Flores', 'Rivera', 'Gómez', 'Díaz', 'Cruz', 'Morales',
            'Jiménez', 'Ruiz', 'Álvarez', 'Castillo'
        ];
        return $apellidos[array_rand($apellidos)];
    }
}