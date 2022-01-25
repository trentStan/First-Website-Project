<?php

include 'database.php';
$date = date('Y') . '-' . date('m') . '-' . date('d');

session_start();
$admin = file_get_contents("admin.json");
$admin = json_decode($admin);

if (!$_SESSION['email'] == $admin->email) {
  header('Location: main.php');
}
$sql = "SELECT * FROM MENU";
$result = $conn->query($sql);

$pendingSql = "SELECT * FROM `order`, `menu` WHERE `dateOfEvent` >= '$date' AND `Menu_idMenu` = `idMenu` ";
$pendingRes = $conn->query($pendingSql);
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
  <title>Admin</title>


</head>
<header>

  <div class="header">
    <a href="#default" class="logo">Trieune Caterers</a>
    <div class="header-right">
      <a class="active" href="#home">Home</a>
      <a href="#contact">Contact</a>
      <a href="#about">About</a>
      <a id="logout" href="logout.php">LOG OUT</a>

    </div>
  </div>

</header>

<body>
  <h2>Admin</h2>
  <?

  if (isset($_GET['type'])) {
    $type = $_GET['type'];

    if ($type == 1) {
  ?><label for="" style="color: green; font-size: 25px;"> <? echo 'Menu Added' ?></label> <?;
                                                                                        }
      else if ($type == 2) {
        ?><label for="" style="color: red; font-size: 25px;"> <? echo 'Menu Removed' ?></label> <?
      }
                                                                                      }
                                                                                          ?>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->



  <div class="container">
    <div class="row">
      <div class="col">
        <h3>Menu List</h3>
        <div class="table-responsive">
          <table class="table">
            <thead class="table-dark">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Deletion?</th>
                <th scope="col">Price P.P</th>
                <th scope="col">Starter</th>
                <th scope="col">Meals</th>
                <th scope="col">Dessert</th>
                <th scope="col">Drinks</th>
              </tr>
            </thead>
            <tbody style=" overflow:auto; Border: 2px solid black; max-height: 20px">
              <? while ($row = $result->fetch_assoc()) { ?>
                <tr class="clickable-row" id="<? echo $row['idMenu']; ?>">

                  <th scope="row"><? echo $row['name']; ?></th>
                  <td><button onclick="deleteMenu(<? echo $row['idMenu'] ?>)" id="delete">Delete</button></td>
                  <td><? echo $row['pricePerPerson']; ?></td>
                  <td><? echo $row['starter'] ?></td>
                  <td><? echo $row['meals'] ?></td>
                  <td><? echo $row['dessert'] ?></td>
                  <td><? echo $row['drinks'] ?></td>
                </tr>
              <? } ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col">
        <br>
        <h3>Pending Orders</h3>
        <div class="table-responsive">

          <table class="table">
            <thead class="table-dark">
              <tr>
                <th>Customer Email</th>
                <th scope="col">Date Ordered</th>
                <th scope="col">dateOfEvent</th>
                <th scope="col">Menu</th>
                <th scope="col">No. People</th>
                <th scope="col">venueAddress</th>
                <th scope="col">decor</th>
                <th scope="col">videography</th>
                <th scope="col">photography</th>
                <th scope="col">publicAddress</th>
                <th scope="col">totalAmt</th>

              </tr>
            </thead>
            <tbody style=" overflow:auto; Border: 2px solid black; max-height: 100px">
              <? while ($row = $pendingRes->fetch_assoc()) { ?>
                <tr class="selected" id="<? echo $row['idOrder']; ?>">
                  <th scope="row"><? echo $row['Customer_email']; ?></th>
                  <td><? echo $row['dateOrdered']; ?></td>
                  <td><? echo $row['dateOfEvent']; ?></td>
                  <td><? echo $row['name']; ?></td>
                  <td><? echo $row['numPeople']; ?></td>
                  <td><? echo $row['venueAddress']; ?></td>
                  <td><?
                      if ($row['decor'] == 1) {
                        echo 'yes';
                      } else {
                        echo 'no';
                      }
                      ?></td>
                  <td><? if ($row['videography'] == 1) {
                        echo 'yes';
                      } else {
                        echo 'no';
                      } ?></td>
                  <td><? if ($row['photography'] == 1) {
                        echo 'yes';
                      } else {
                        echo 'no';
                      } ?></td>
                  <td><? if ($row['publicAddress'] == 1) {
                        echo 'yes';
                      } else {
                        echo 'no';
                      } ?></td>
                  <td><? echo $row['totalAmt']; ?></td>
                </tr>
              <? } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col">
        <fieldset id="forms">
          <legend>Add menu</legend>
          <form action="addMenu.php" method="post">
            <table>
              <tr>
                <td>Name:</td>
                <td><input type="text" name="name" id="name" required></td>
              </tr>
              <tr>
                <td>Starter:</td>
                <td><textarea name="starter" id="starter" cols="30" rows="10" required></textarea></td>

                <td style="padding-left: 35px;">Meals:</td>
                <td><textarea name="meals" id="meals" cols="30" rows="10" required></textarea></td>
              </tr>
              <tr>
                <td>Dessert:</td>
                <td><textarea name="dessert" id="dessert" cols="30" rows="10" required></textarea></td>

                <td style="padding-left: 35px;">Drinks:</td>
                <td><textarea name="drinks" id="drinks" cols="30" rows="10" required></textarea></td>
              </tr>
              <tr>
                <td>Price P.P</td>
                <td><input type="number" name="ppp" id="ppp" required></td>
              </tr>
              <tr>
                <td colspan="2"><button type="submit">Add menu</button></td>
              </tr>
            </table>
          </form>
        </fieldset>
      </div>

    </div>
  </div>

  <script>
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

    function deleteMenu(id) {

      var check = confirm("Do you want to delete Menu ID: " + id)
      if (check) {
        xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4) {
            location.replace('admin.php?type=2')
          }
        };

        xmlhttp.open("POST", "delete.php");
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send('menuID=' + id);
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



    function logout() {
      xmlhttp = new XMLHttpRequest();

      xmlhttp.open("GET", "logout.php", true);
      xmlhttp.send();
    }
  </script>

</body>

</html>