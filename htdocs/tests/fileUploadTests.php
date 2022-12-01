<?php declare(strict_types=1);

require_once('../fileUploadScript.php');

use PHPUnit\Framework\TestCase;

final class UploadTest extends TestCase{
	
	
	public function testDirectoryCreation{
		
		$script = new UploadScript("testUser");
		
		$this->assertSame($script->createDirectory(), false);
		$this->assertSame($script->createDirectory(), true);
		
	}
	
	public function testGoodFileExt(){
		
		$script = new UploadScript("testUser");

		
		$this->assertSame($script->isFileExtAllowed(".jpg"),true);
		
	}
	
	public function testBadFileExt(){
		$script = new UploadScript("testUser");
		
		$this->assertSame($script->isFileExtAllowed(".txt"),false);
		
	}
	
	public function testGoodFileSize(){
		$script = new UploadScript("testUser");
		
		$this->assertSame($script->isFileSizeOk(500),true);
		
	}
	
	public function testBadFileSize(){
		$script = new UploadScript("testUser");
		
		$this->assertSame($script->isFileSizeOk(4000001),false);
		
	}
	
	public function testNumFileCreation(){ 
		$script = new UploadScript("testUser");
		
		$this->assertSame($script->createNumFile(),false);
		$this->assertSame($script->createNumFile(), true);
	}
	
	public function testGoodKeywordAddition(){ 
		$script = new UploadScript("testUser");
		
		$this->assertSame($script->addKeywords("devin,devin,devin"),true);
	}
	
	public function testBadKeywordAddition(){ 
		$script = new UploadScript("testUser");
		
		$this->assertSame($script->addKeywords(""),true);
	}
	
}


?>