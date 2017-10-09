<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>home</title>
  </head>
  <body>

    <h2>Signup</h2>
    <form class="form" action="auth.php" method="post">
      <input type="text" name="username" placeholder="username">
      <input type="password" name="password" placeholder="password">
      <input type="mail" name="mail" placeholder="e-mail">
      <input type="hidden" name="type" value="signup">
      <input type="submit" value="submit">
    </form>
    <h2>Login</h2>
    <form class="form" action="auth.php" method="post">
      <input type="text" name="username" placeholder="username">
      <input type="password" name="password" placeholder="password">
      <input type="hidden" name="type" value="login">
      <input type="submit" value="submit">
    </form>


  </body>
</html>
