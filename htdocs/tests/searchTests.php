<?php declare(strict_types=1);
require_once('../searchScript.php');

use PHPUnit\Framework\TestCase;

final class SearchTest extends TestCase{
	
	
	public function testNoResultsCheck() : void {
        $this->expectOutputString("No images found matching keyword. Returning to search page...");

        $s = new searchScript("test");
        $s->noResultsCheck(0, 1);
    }

    public function testNoResultsCheckFail() : void {
        $s = new searchScript("test");
        $this->assertSame(false, $s->noResultsCheck(0, 0));
    }

    public function testPrintLink() : void {
        $un = "test";
        $this->expectOutputString("<a href='search.php?username={$un}'>Back to Search Page</a>");

        $s = new searchScript($un);
        $s->printLink(1);
    }

    public function testPrintLinkFail() : void {
        $s = new searchScript("test");
        $this->assertSame(false, $s->printLink(0));
    }
	

}


?>