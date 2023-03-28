


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <style>
        #checkPassword {
      display: none;
      }
      .hideText, .showText {
      border: none;
      outline: none;
      }
      .togglePassword {
      border: 1px solid;
      border-radius: 2px;
      width: 205px;
      }
      .showText {
      display: none;
      }
      .hideText {
      display: inline;
      }


      .fa-eye:before {
      display: inline;
      margin-left: 5px; 
      }
      .fa-eye-slash:before {
      display: none;
      }




      #checkPassword:checked + .togglePassword > .fa-eye:before {
      display: none;
      }
      #checkPassword:checked + .togglePassword > .fa-eye-slash:before {
      display: inline-block;
      }
      #checkPassword:checked + .togglePassword > .hideText {
      display: none;
      }
      #checkPassword:checked + .togglePassword > .showText {
      display: inline-block;
      }
    </style>

  </head>


  <body>
    <input type="checkbox" id="checkPassword">
    <div class="togglePassword">
      <input type="password" class="hideText" value="password123">
      <input type="text" class="showText" value="password123">
      <label for="checkPassword" class="fa fa-eye"></label>
      <label for="checkPassword" class="fa fa-eye-slash"></label>
    </div>
  </body>
</html>