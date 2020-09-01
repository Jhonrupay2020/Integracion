<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testForm()
    {
    	$params=[
    	'name'=>"Jarita",
    	'phone'=>'99987565'
    	];
        $response=$this->call("POST","/person/save",$params);
        $response->assertRedirect("/person/list");
    }
}
