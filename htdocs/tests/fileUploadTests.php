<?php declare(strict_types=1);

require_once('C:/Apache24/htdocs/fileUploadScript.php');

use PHPUnit\Framework\TestCase;


final class fileUploadTests extends TestCase{
	
	
	public function testGoodFileExt(){
		
		$script = new UploadScript('testUser');

		
		$this->assertTrue($script->isFileExtAllowed_t("jpg"));
		
	}
	
	public function testBadFileExt(){
		$script = new UploadScript('testUser');
		
		$this->assertFalse($script->isFileExtAllowed_t("txt"));
		
	}
	
	public function testGoodFileSize(){
		$script = new UploadScript('testUser');
		
		$this->assertTrue($script->isFileSizeOk_t(500));
		
	}
	
	public function testBadFileSize(){
		$script = new UploadScript('testUser');
		
		$this->assertFalse($script->isFileSizeOk_t(4000001));
		
	}

	
	public function testGoodKeywordAddition(){ 
		$script = new UploadScript('testUser');

		$this->assertSame($script->addKeywords("devin,devin,devin"),true);
	}
	
	public function testBadKeywordAddition(){ 
		$script = new UploadScript('testUser');

		$this->assertSame($script->addKeywords(""),false);
	}
	
}


?>