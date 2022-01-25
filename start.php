<?php

include 'database.php';

$sql = "SELECT * FROM MENU";
$result = $conn->query($sql);

if(isset($_GET['error'])) {
  $error_id = $_GET['error'];
  switch($error_id) {
    case 1:
      $error = "Incorrect email or password.";
    break;
    case 2: 
      $error = "Email exists";
      break;
  }
}


?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <link rel="stylesheet" href="css/custom.css">
  <title>Trieune Caterers</title>


</head>
<header>
  
  <div class="header">
    <a href="#default" class="logo">Trieune Caterers</a>
    <div class="header-right">
      <a class="active" href="#home">Home</a>
      <a href="#contact">Contact</a>
      <a href="#about">About</a>
      <a id="loginBtn" onclick="document.getElementById('id01').style.display='block'">LOGIN</a>
      <a id="sign-upBtn" onclick="document.getElementById('id02').style.display='block'">SIGN-UP</a>
    </div>
  </div>

</header>

<body>



  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->

  <div id="id01" class="modal">

    <form class="modal-content animate" action="login.php" method="post">

      <div class="container">
        <h2 style="text-align: center;">Login</h2>

        <label style="color: red;" id="errorlogin" hidden></label> <br>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>

      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>
  </div>

  <div id="id02" class="modal">

    <form class="modal-content animate" action="register.php" method="POST">
      <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <label style="color: red;" id="errorRegister" hidden></label> <br>
        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>

        <label for="surname"><b>Surname</b></label>
        <input type="text" placeholder="Enter Surname" name="surname" required>

        <label for="email"><b>Email</b></label> <br>
        <input type="email" placeholder="Enter Email" name="email" required> <br>

        <label for="cellNum"><b>Cell Phone Number</b></label> <br>
        <input type="number" placeholder="Eg. 076 xxx xxxx" name="cellNum" required> <br>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

        <label>
          <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
          <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
          <button type="submit" class="signupbtn">Sign Up</button>
        </div>
      </div>
    </form>
  </div>

  <?php if ($result->num_rows > 0) {  ?>
    <div class="container">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="card">
          <div class="card-header"><strong><?php echo $row['name'] ?></strong> <br>
            Price Per Person: R<? echo $row['pricePerPerson'] ?></div>
          <div class="card-body">Starter: <br>
            <? echo $row['starter'] ?></div>
          <div class="card-body"> Meals: <br> <? echo $row['meals'] ?><br></div>
          <div class="card-body">Dessert: <br> <? echo $row['dessert'] ?> </div>
          <div class="card-footer">Drinks: <br> <? echo $row['drinks'] ?></div>
        </div>
    </div>
<?php }
    } ?>

<script>

    if(<?echo $error_id ?> == 1){      
      document.getElementById('errorlogin').innerHTML = "<?echo $error?>";
      document.getElementById('errorlogin').removeAttribute('hidden');
      document.getElementById('id01').style.display='block'
    }

    if(<?echo $error_id ?> == 2){      
      document.getElementById('errorRegister').innerHTML = "<?echo $error?>";
      document.getElementById('errorRegister').removeAttribute('hidden');
      document.getElementById('id02').style.display='block'
    }
  // Get the modal
  var loginModal = document.getElementById('id01');
  var registerModal = document.getElementById('id02');
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == loginModal) {
      loginModal.style.display = "none";
    }
    if (event.target == registerModal) {
      registerModal.style.display = "none";
    }
  }

  // When the user scrolls the page, execute myFunction
  window.onscroll = function() {
    floatHeader()
  };

  // Get the header
  var header = document.getElementById("myHeader");

  // Get the offset position of the navbar
  var sticky = header.offsetTop;

  // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function floatHeader() {
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
    } else {
      header.classList.remove("sticky");
    }
  }
</script>

</body>

</html>