<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <style>
      .text {color: red;}
    </style>
  </head>

  <body>

    <h1>Login Page</h1>

    <?php
        $return_message = "";
    ?>

    <form method="POST">

      <label for="username">Username: </label>
      
      <input name="username" type="text" placeholder="Enter Username" id="username">
      <br>

      <label for="password">Password:</label>
      
      <input name="password" type="password" placeholder="Enter Password" id="password">
      <br>

      <button name="login_btn" id="login_btn" type="submit">Login</button> 
      <!-- <button id = "login_btn" type="submit" onclick = "login()">Login</button>-->
      <br>

      <button type="button" id="create_btn" onclick ="signup_page()">Create An Account</button>
      <br>

      <button name="signup_btn" id="signup_btn" type="submit" hidden>Signup</button>
      <!-- <button id = "signup_btn" onclick = "signup()" hidden>Signup</button> -->
      <br>
      <br>
      
      

    </form>  

    <?php
        require_once('C:/Apache24/htdocs/loginScript.php');

        if (isset($_POST['signup_btn']))
        //if(array_key_exists('signup_btn',$_POST))
        {
          $script = new login_script();

          $u_name = isset($_POST["username"] ) ? $_POST["username"]: '';
          $pswrd =  isset($_POST["password"] ) ? $_POST["password"]: '';

          $return_message = $script->signup($u_name, $pswrd);

          echo "<script>console.log('Debug Objects: " . $return_message . "' );</script>";

          if ($return_message == "Account created")
          {
            echo "<script> signup(); </script>";
          }

          echo "<label class = \"text\" id = \"text\">{$return_message}</label>";
        }

        if (isset($_POST['login_btn']))
        //if(array_key_exists('login_btn',$_POST))
        {
          
          $script = new login_script();

          $u_name = isset($_POST["username"] ) ? $_POST["username"]: '';
          $pswrd =  isset($_POST["password"] ) ? $_POST["password"]: '';

          //echo "<label class = \"text\" id = \"text\">{$return_message}</label>";
          echo "<script>console.log('Debug Objects: " . $u_name . "' );</script>";
          echo "<script>console.log('Debug Objects: " . $pswrd . "' );</script>";

          $return_message = $script->login($u_name, $pswrd);

          if ($return_message == "Login successful")
          {
            header("Location: mainpage.php?username=" . $u_name);
          }
          else
          {
            echo "<label class = \"text\" id = \"text\">{$return_message}</label>";
          }

        }

    ?>

    <script>
      var create_btn = document.getElementById('create_btn');
      var login_btn = document.getElementById('login_btn');
      var signup_btn = document.getElementById('signup_btn');
      var username = document.getElementById('username');
      var password = document.getElementById('password');

      function clean_html()
      {
        let d = document.getElementById('text');
        if (d)
        {
          d.remove();
        }
      }

      function signup_page()
      {
        create_btn.setAttribute('hidden', true);
        login_btn.setAttribute('hidden', true);
        signup_btn.removeAttribute('hidden');

        username.placeholder = 'Enter new username';
        password.placeholder = 'Enter new password';

        username.value = "";
        password.value = "";

        clean_html();
      }

      function signup()
      {
        create_btn.removeAttribute('hidden');
        login_btn.removeAttribute('hidden');
        signup_btn.setAttribute('hidden', true);

        username.placeholder = 'Enter username';
        password.placeholder = 'Enter password';

        }
    </script>

  </body>
</html>