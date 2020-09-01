<?php
use PHPUnit\Framework\TestCase;
final class SuscriptionBusinessTest extends TestCase{
	public function testSave():void{
		include_once "../classes/Suscription.php";
		include_once "../suscription.php";
		include_once "../config/db.php";
		$business=new SuscriptionBusiness();
		$data=[
			'system'=>'clasesVirtuales', 
			'initdate'=>'01/05/2018', 
			'enddate'=>'30/05/2018',
			'user_id'=>1];
		$this->assertEquals($business->register($data), null);
	}
	public function testList():void{
		$business=new SuscriptionBusiness();
		$this->assertEquals( is_array($business->list()), true );
	}
}
?>