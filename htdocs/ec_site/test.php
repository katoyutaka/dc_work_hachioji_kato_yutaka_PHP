<!DOCTYPE html>
<html>
<head>
  <title>Password Toggle</title>
</head>
<body>
  <form method="post">
    <input type="password" name="password" placeholder="Password">
    <input type="checkbox" name="show_password" id="showPassword">
    <label for="showPassword">Show Password</label>
    <input type="submit" value="Submit">
  </form>
  
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $showPassword = isset($_POST['show_password']);
    
    if ($showPassword) {
      echo "Password: $password";
    } else {
      echo "Password is hidden";
    }
  }
  ?>
</body>
</html>
