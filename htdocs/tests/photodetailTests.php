<?php declare(strict_types=1);

require_once('C:/Apache24/htdocs/photodetailScript.php');

use PHPUnit\Framework\TestCase;

final class photodetailTests extends TestCase{
  public function testKeys(){
    $script = new photodetail('a', 2, '../images/a/2.jpg');
    $this->assertSame($script->list_keywords(), "'toothpaste' ");
  }
   public function testKeys2(){
    $script = new photodetail('a', 3, '../images/a/3.jpg');
    $this->assertSame($script->list_keywords(), "'sick' 'flu' ");
  }
 public function testKeys3(){
    $script = new photodetail('b', 0, '../images/b/0.jpg');
    $this->assertSame($script->list_keywords(), "'walking' 'shoes' ");
  }
}


?>