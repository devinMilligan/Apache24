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

    <div>
      <label for="username">Username: </label>
      <input type="text" placeholder="Enter Username" id="username">
      <br>

      <label for="password">Password:</label>
      <input type="password" placeholder="Enter Password" id="password">
      <br>

      <button id = "login_btn" type="submit" onclick = "login()">Login</button>
      <br>

      <button id = "create_btn" onclick = "signup_page()">Create An Account</button>
      <br>

      <button id = "signup_btn" onclick = "signup()" hidden>Signup</button>
      <br>

      <br><label class = "text" id = "text"></label>
    </div>

    <script>
      var create_btn = document.getElementById('create_btn');
      var login_btn = document.getElementById('login_btn');
      var signup_btn = document.getElementById('signup_btn');
      var username = document.getElementById('username');
      var password = document.getElementById('password');
      var msg = document.getElementById('text');

      function login()
      {
        if (username.value == "" || password == "")
        {
          msg.innerHTML = 'Please enter username and password.'
        }
        else if (localStorage.getItem(username.value) == null)
        {
          msg.innerHTML = 'Invalid username. Please try again.'
        }
        else if (localStorage.getItem(username.value) == password.value)
        {
          msg.innerHTML = 'Login successful.'
          window.location = 'mainpage.php?username=' + username.value;
        }
        else
        {
          msg.innerHTML = 'Wrong password. Please try again.'
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
      }
      function signup()
      {
        if (username.value == "" || password.value == "")
        {
          msg.innerHTML = 'Please enter username and password.'
        }
        else if (localStorage.getItem(username.value) != null)
        {
          msg.innerHTML = 'Username already exists. Please select another one.'
        }
        else
        {
          localStorage.setItem(username.value, password.value);

          create_btn.removeAttribute('hidden');
          login_btn.removeAttribute('hidden');
          signup_btn.setAttribute('hidden', true);

          username.placeholder = 'Enter username';
          password.placeholder = 'Enter password';

          msg.innerHTML = 'Account created. Login using new credentials.'
        }
      }
    </script>

  </body>
</html>