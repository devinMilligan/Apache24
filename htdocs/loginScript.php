<?php
    error_reporting(E_ALL ^ E_NOTICE);

    class login_script
    {
        public function login($input_username, $input_password): String
        {
            if ($input_username == "" || $input_password == "")
            {
                return "Please enter username and password";
            }

            $credentials_directory = "c:/Apache24/htdocs/credentials";
            $user_directory = $credentials_directory . "/" . $input_username . "/";

            if (!is_dir($user_directory))
            {
                return "Invalid username";
            }
            else
            {
                $password_filename = $user_directory . "password.txt";

                $myfile = fopen($password_filename, "r");
                $password = fread($myfile,filesize($password_filename));

                fclose($myfile);

                if ($password == $input_password)
                {
                    return "Login successful";
                }
                else // invalid password
                {
                    return "Wrong password";
                }
            }
        }

        public function signup($input_username, $input_password): String
        {
            if ($input_username == "" || $input_password == "")
            {
                return "Please enter username and password";
            }

            $credentials_directory = "c:/Apache24/htdocs/credentials/";
            $user_directory = $credentials_directory . $input_username . "/";

            if (!is_dir($user_directory))
            {
                mkdir($user_directory, 0777, true);

                file_put_contents($user_directory . "password.txt", $input_password);

                return "Account created";
            }
            else
            {
                return "Username already exists";
            }
        } 
    }

?>