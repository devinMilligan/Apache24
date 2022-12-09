<?php declare(strict_types=1);

require_once('C:/Apache24/htdocs/mainpageScript.php');

use PHPUnit\Framework\TestCase;


final class mainpageTests extends TestCase{

    public function testNumImages() {
        $script = new mainpage('testUser');
        $this->assertSame($script->getImages(), 0);
    }

    public function testNumImages2() {
        $script = new mainpage('nmorris');
        $this->assertSame($script->getImages(), 10);
    }

    public function testCorrectUsername() {
        $script = new mainpage('testUser');
        $this->assertSame($script->getUsername(), 'testUser');
    }

    public function testPWD() {
        $script = new mainpage('testUser');
        $this->assertSame($script->getPWD(), 'C:\Apache24\htdocs');
    }

    public function testImageDirectory() {
        $script = new mainpage('testUser');
        $this->assertSame($script->getImageDirectory(), '/images/testUser/');
    }	
}

?>