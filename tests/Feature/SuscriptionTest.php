<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\SuscriptionController;

class SuscriptionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testExample()
    {
    	$suscriptionController=new SuscriptionController();
    	$response=$suscriptionController->list();
    	$response=json_decode($response);
        $this->assertTrue( is_array($response) );
        //$this->visit("/")->see("Laravel");
        $response=$this->get("/api/suscriptions/list");
        $response->assertSee("sarita");
    }*/

    public function testExample(){
    	$response = $this->call('POST', '/api/suscriptions/list');
    	//$this->assertEquals('Hello World', $response->getContent());
    	$this->assertSee( "id", $response->getContent() );
    }
}
