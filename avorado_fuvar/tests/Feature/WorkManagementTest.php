<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\StatusesSeeder;
use App\Models\User;
use App\Models\Work;

class WorkManagementTest extends TestCase
{
    // A teszt után minden módosítást visszavon az adatbázisban
    use RefreshDatabase; 

    /** @test */
    public function an_authenticated_user_can_create_a_work()
    {
        $statusesTable = new StatusesSeeder();
        $statusesTable->run();
        $userAdmin = User::factory()->admin()->create();
        $userCarrier = User::factory()->carrier()->create();
        $now = date('Y-m-d H:i:s');
        $workData = [
            'start_place'     => '1024 Bp. Pál utca 7.',
            'end_place'       => '1059 Bp. Nagy Józsi utca 9.',
            'recipient_name'  => 'Bubó dr.',
            'recipient_phone' => '+36709541113', 
            'created_at'      => $now,
            'updated_at'      => $now,
            'carrier' => $userCarrier->id,
            'status'  => 1,
        ];

        $response = $this->actingAs($userAdmin)->post(route('works.store'), $workData);

        // 3. Assert (Ellenőrzés)
        
        // Ellenőrizzük, hogy az adatbázis tartalmazza az új rekordot
        $this->assertDatabaseHas('works', [
            'start_place'     => '1024 Bp. Pál utca 7.',
            'end_place'       => '1059 Bp. Nagy Józsi utca 9.',
            'recipient_name'  => 'Bubó dr.',
            'recipient_phone' => '+36709541113', 
            'created_at'      => $now,
            'updated_at'      => $now,
            'carrier' => $userCarrier->id,
            'status'  => 1,
        ]);
        
        $response->assertRedirect(route('works.index')); 
        $statusesTable->down();
        

    }

    /** @test */
    public function creation_requires_datas()
    {
        $statusesTable = new StatusesSeeder();
        $statusesTable->run();
        $userAdmin = User::factory()->admin()->create();
        $userCarrier = User::factory()->carrier()->create();
        $now = date('Y-m-d H:i:s');

        $response = $this->actingAs($userAdmin)->post(route('works.store'), [
            'start_place'     => '',
            'end_place'       => '',
            'recipient_name'  => '',
            'recipient_phone' => '', 
            'created_at'      => $now,
            'updated_at'      => $now,
            'carrier' => $userCarrier->id,
            'status'  => 1,
        ]);
        $response->assertSessionHasErrors('start_place');
        $response->assertSessionHasErrors('end_place');
        $response->assertSessionHasErrors('recipient_name');
        $response->assertSessionHasErrors('recipient_phone');
        
    }

    /** @test */
    public function update_datas()
    {
        $statusesTable = new StatusesSeeder();
        $statusesTable->run();
        $userAdmin = User::factory()->admin()->create();
        $userCarrier = User::factory()->carrier()->create();
        $now = date('Y-m-d H:i:s');

        $workData = [
            'start_place'     => '1024 Bp. Pál utca 7. Egyedi',
            'end_place'       => '1059 Bp. Nagy Józsi utca 9.',
            'recipient_name'  => 'Ferenc dr.',
            'recipient_phone' => '+36709541113', 
            'created_at'      => $now,
            'updated_at'      => $now,
            'carrier' => $userCarrier->id,
            'status'  => 1,
        ];
        $work = Work::factory()->create($workData); 

       // Az új adatok
        $updatedData = [
            'id' => $work->id,
            'start_place' => 'Frissített munka címe',
            'end_place'       => '1059 Bp. Nagy Józsi utca 9.',
            'recipient_name'  => 'Ferenc dr.',
            'recipient_phone' => '+36302224444',
            
            'carrier' => $userCarrier->id,
            'status'  => 2,
            
        ];

        // 2. Act
        $response = $this->actingAs($userAdmin)->patch(route('works.update'), $updatedData);
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors();
        if ($response->exception) {
        // Kiírja a PHP hibaüzenetet a konzolra
            throw $response->exception; 
        }   
        $response->assertRedirect(route('works.index')); 
     
        // Ellenőrizzük, hogy az adatbázisban a változások megjelentek
        $this->assertDatabaseHas('works', [
            'id' => $work->id,
            'start_place' => 'Frissített munka címe',
            'end_place'       => '1059 Bp. Nagy Józsi utca 9.',
            'recipient_name'  => 'Ferenc dr.',
            'recipient_phone' => '+36302224444',
            
            'carrier' => $userCarrier->id,
            'status'  => 2,
            
        ]);
        
        // Ellenőrizzük, hogy az eredeti cím már nem létezik az adatbázisban
        $this->assertDatabaseMissing('works', [
            'start_place'     => '1024 Bp. Pál utca 7. Egyedi'
        ]);
        $statusesTable->down(); 
    }
    
    /** @test */
    public function update_datas_carrier()
    {
        $statusesTable = new StatusesSeeder();
        $statusesTable->run();
        $userAdmin = User::factory()->admin()->create();
        $userCarrier = User::factory()->carrier()->create();
        $now = date('Y-m-d H:i:s');

        $workData = [
            'start_place'     => '1024 Bp. Pál utca 7. Egyedi',
            'end_place'       => '1059 Bp. Nagy Józsi utca 9.',
            'recipient_name'  => 'Ferenc dr.',
            'recipient_phone' => '+36709541113', 
            'created_at'      => $now,
            'updated_at'      => $now,
            'carrier' => $userCarrier->id,
            'status'  => 1,
        ];
        $work = Work::factory()->create($workData); 

       // Az új adatok
        $updatedData = [
            'id' => $work->id,
            'status'  => 2,
            
        ];

        // 2. Act
        $response = $this->actingAs($userCarrier)->patch(route('works.updatecarrier'), $updatedData);
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors();
        if ($response->exception) {
        // Kiírja a PHP hibaüzenetet a konzolra
            throw $response->exception; 
        }   
        $response->assertRedirect(route('works.index')); 
     
        // Ellenőrizzük, hogy az adatbázisban a változások megjelentek
        $this->assertDatabaseHas('works', [
            'id' => $work->id,
            'carrier' => $userCarrier->id,
            'status'  => 2,
            
        ]);
        
        // Ellenőrizzük, hogy az eredeti cím már nem létezik az adatbázisban
        $statusesTable->down(); 
    }
}
