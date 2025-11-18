<?php
namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use App\Models\Work; 

class WorkTest extends TestCase
{
    /**
     * @test
     * Ellenőrzi, hogy a Work modell képes-e egy korrekt start címet generálni.
     */
    public function work_can_generate_a_correct_start_place()
    {
        
        $work = new Work();

        $work->start_place = '2100 Gödöllő Rózsa utca 7.'; 

        $expectedStartPlace = '2100 Gödöllő Rózsa utca 7.';
        $actualStartPlace = $work->start_place; 

        $this->assertEquals($expectedStartPlace, $actualStartPlace);
        
        $this->assertIsString($actualStartPlace);
        $this->assertStringContainsString('Gödöllő', $actualStartPlace);
       
    }

    /**
     * @test
     * Ellenőrzi, hogy a Work modell képes-e egy korrekt end címet generálni.
     */
    public function work_can_generate_a_correct_end_place()
    {
        $work = new Work();

        $work->end_place = '2100 Gödöllő Rózsa utca 7.'; 

        $expectedEndPlace = '2100 Gödöllő Rózsa utca 7.';
        $actualEndPlace = $work->end_place; 

        $this->assertEquals($expectedEndPlace, $actualEndPlace);
        
        $this->assertIsString($actualEndPlace);
        $this->assertStringContainsString('Gödöllő', $actualEndPlace);
    }
    // recipient_name	recipient_phone	
    
    /**
     * @test
     * Ellenőrzi, hogy a Work modell képes-e egy korrekt megrendelő generálni.
     */
    public function work_can_generate_a_correct_recipient_name()
    {
                
        $work = new Work();

        $work->recipient_name = 'Kiss József'; 

        $expectedRecipientName = 'Kiss József';
        $actualRecipientName = $work->recipient_name; 

        $this->assertEquals($expectedRecipientName, $actualRecipientName);
        
        $this->assertIsString($actualRecipientName);
        $this->assertStringContainsString('Kiss', $actualRecipientName);
        
    }
    /**
     * @test
     * Ellenőrzi, hogy a Work modell képes-e egy korrekt megrendelő telefonszám generálni.
     */
    public function work_can_generate_a_correct_recipient_phone()
    {
        
        $work = new Work();

        $work->recipient_phone = '+36701237654'; 

        $expectedRecipientPhone = '+36701237654';
        $actualRecipientPhone = $work->recipient_phone; 

        $this->assertEquals($expectedRecipientPhone, $actualRecipientPhone);
        
        $this->assertIsString($actualRecipientPhone);
        $this->assertStringContainsString('+3670', $actualRecipientPhone);
    }
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}

