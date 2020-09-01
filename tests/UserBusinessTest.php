<?php
use PHPUnit\Framework\TestCase;

final class UserBusinessTest extends TestCase{
	public function testSave():void{
		include_once "src/business/userBusiness.php";
		include_once "src/entity/user.php";
		include_once "src/entity/db.php";
		
		$business=new UserBusiness();
		$data=['name'=>'testName', 'lastname'=>'LnTest', 'email'=>'123'];
		$this->assertEquals($business->registerUser($data), null);
	}
	public function testList():void{
		$business=new UserBusiness();
		$this->assertEquals( is_array($business->list()), true );
	}
	
}
?>