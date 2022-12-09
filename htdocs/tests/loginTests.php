<?php declare(strict_types=1);

require_once('C:/Apache24/htdocs/loginScript.php');

use PHPUnit\Framework\TestCase;

final class loginTests extends TestCase
{
    public function test_login_empty_username_or_password() 
    {
        $script = new login_script();
        $this->assertSame($script->login("", ""), "Please enter username and password");
    }

    public function test_login_invalid_username() 
    {
        $script = new login_script();
        $this->assertSame($script->login("jhgjhgjhgjhg", "123"), "Invalid username");
    }

    public function test_login_wrong_password() 
    {
        $script = new login_script();
        $this->assertSame($script->login("user", "wrong_password_"), "Wrong password");
    }

    public function test_login_successful() 
    {
        $script = new login_script();
        $this->assertSame($script->login("user", "123"), "Login successful");
    }

    public function test_signup_username_already_exists() 
    {
        $script = new login_script();
        $this->assertSame($script->signup("user", "123"), "Username already exists");
    }

    public function test_signup_successful() 
    {
        $script = new login_script();
        $this->assertSame($script->signup("user". rand(0,100), "123"), "Account created");
    }

    public function test_signup_empty_username_or_password() 
    {
        $script = new login_script();
        $this->assertSame($script->signup("", ""), "Please enter username and password");
    }
}

?>