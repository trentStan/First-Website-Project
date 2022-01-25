<?php
session_start();
include 'database.php';
//include 'convertCurrency.php';
if (!isset($_SESSION['email'])) {
    header('Location: main.php');
}
$prices = file_get_contents('prices.json');
$prices = json_decode($prices);
$email = $_SESSION['email'];
$accountSql = "SELECT * FROM customer WHERE email='$email'";
$account = $conn->query($accountSql);

$rate = 0.070;  // ZARtoUSD(1);

$menuSql = "SELECT `name`, `pricePerPerson` FROM menu";
$result = $conn->query($menuSql);

// Declare a date
$date = date_create(date('Y') . "-" . date('m') . "-" . date('d'));

// Use date_add() function to add date object
date_add($date, date_interval_create_from_date_string("7 days"));

// Display the added date

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
    <title>Customer</title>


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



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
    <? if (isset($_GET)) {
        if (isset($_GET['success'])) {
    ?>
            <label><strong><? echo 'order booked' ?></strong> </label>
        <? } else if (isset($_GET['error'])) {?>
            <label><strong><? echo 'order failed' ?></strong></label>
    <? }
    } ?>

    <h2>Welcome <? echo $account->fetch_assoc()['name'] ?></h2>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <fieldset id="forms">
                    <legend>Book service</legend>
                    <table>
                        <tr>
                            <td>Choose Menu:</td>
                            <td><select name="menu" id="menu" required>
                                    <option value="0" disabled selected>Select Menu:</option>
                                    <? while ($row = $result->fetch_assoc()) { ?>
                                        <option value="<? echo $row['pricePerPerson'] ?>" id="<?echo $row['idMenu']?>"><? echo $row['name'] ?>: R<? echo $row['pricePerPerson'] ?></option>
                                    <? } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Number of people to serve:</td>
                            <td><input type="number" id="numServe" defaultValue=30 value="30" min=30 step="1"></td>
                        </tr>
                        <tr>
                            <th>Select extra services</th>
                        </tr>
                        <tr>

                            <td><input type="checkbox" id="decor" name="decor" value="0">
                                Decor +R<? echo $prices->decor ?></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="video" name="video" value="0">
                                Videography +R<? echo $prices->video ?></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="photo" name="photo" value="0">
                                Photography +R<? echo $prices->photo ?></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="pa" name="pa" value="0">
                                <label for="pa">Public Address System +R<? echo $prices->pa ?></label>
                            </td>
                        </tr>
                        <tr>
                            <th>Date of event:</th>
                            <td><input type="date" min="<? echo date_format($date, "Y-m-d"); ?>" id="eventDate" required /></td>
                        </tr>
                        <tr>
                            <td><label for=""></label></td>
                        </tr>
                        <tr style="border: 1px solid DarkGrey ;">
                            <th style="vertical-align: top;">Venue Address:</th>
                            <td>
                                <address>
                                    <strong style="color: red;">VENUE HAS TO BE WITHIN THE CAPE TOWN MUNICIPALITY</strong>
                                    <img src="cape town.JPG" alt="" width="200px">
                                    <input type="text" name="placeName" id="placeName" placeholder="Name of Venue (Optional)">

                                    <!-- address-line1 input-->
                                    <input id="address-line1" name="address-line1" type="text" placeholder="address line 1" required>
                                    <p class="help-block" style="font-size: 13px;">Street address, P.O. box, company name, c/o</p>


                                    <!-- address-line2 input-->
                                    <input id="address-line2" name="address-line2" type="text" placeholder="address line 2">
                                    <p class="help-block" style="font-size: 13px;">Apartment, suite , unit, building, floor, etc.</p>


                                    <!-- postal-code input-->
                                    <input id="postal-code" name="postal-code" type="text" placeholder="zip or postal code (optional)">
                                    <p class="help-block"></p>

                                </address>
                            </td>
                        </tr>
                        <tr style="border: 2px solid black;">
                            <th>Total: </th>
                            <td><strong>R<label id="total">0</label></strong> <label id="rate" hidden><? echo $rate; ?></label> </td>
                        </tr>
                        <tr>
                            <td>Pay via PayPal:</td>
                            <td>
                                <div id="paypal-payment-button">

                                </div>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </div>
        </div>

        <div class="row"></div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=AS7AKWFzESnXo3iiJAeA7qQV4BU40mDjfNLRcVWqLNbCFyAmIfBnVX5bih5mYFy2Pf_YjbkWQRS7fcDB&disable-funding=credit,card"></script>
    <script src="paypal.js"></script>
    <script>
        var date = new Date();
        var menu = document.getElementById('menu');
        var numServe = document.getElementById('numServe')
        var decor = document.getElementById('decor');
        var video = document.getElementById('video');
        var photo = document.getElementById('photo');
        var pa = document.getElementById('pa');
        var eventDate = document.getElementById('eventDate');
        var total = document.getElementById('total');

        // When the user scrolls the page, execute myFunction
        /* window.onscroll = function() {
             floatHeader()
         };
         */
        // Get the header
        var header = document.getElementById("myHeader");

        // Get the offset position of the navbar
        //var sticky = header.offsetTop;

        // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
        //eventDate.setAttribute('min', date.getFullYear() + "-" + date.getMonth() + "-" + date.getDay()) ;
        function floatHeader() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }

        menu.addEventListener('change', function() {
            changeTotal();
        })

        numServe.addEventListener('change', function() {
            changeTotal();
        })

        decor.addEventListener('click', function() {
            if (decor.checked) {

                decor.setAttribute('value', <? echo $prices->decor; ?>)
            }
            if (!decor.checked) {
                decor.setAttribute('value', 0)
            }
            changeTotal();
        })

        video.addEventListener('click', function() {
            if (video.checked) {

                video.setAttribute('value', <? echo $prices->video; ?>)
            }
            if (!video.checked) {
                video.setAttribute('value', 0)
            }
            changeTotal();
        })

        photo.addEventListener('click', function() {
            if (photo.checked) {

                photo.setAttribute('value', <? echo $prices->photo; ?>)
            }
            if (!photo.checked) {
                photo.setAttribute('value', 0)
            }
            changeTotal();
        })

        pa.addEventListener('click', function() {
            if (pa.checked) {

                pa.setAttribute('value', <? echo $prices->pa; ?>)
            }
            if (!pa.checked) {
                pa.setAttribute('value', 0)
            }
            changeTotal();
        })

        total.innerHTML = parseFloat(decor.getAttribute('value')) + (parseFloat(menu.value) * parseFloat(numServe.value)) + parseFloat(video.value) + parseFloat(photo.value) + parseFloat(pa.value);

        function changeTotal() {
            total.innerHTML = parseFloat(decor.getAttribute('value')) + (parseFloat(menu.value) * parseFloat(numServe.value)) + parseFloat(video.value) + parseFloat(photo.value) + parseFloat(pa.value);

        }

        function logout() {
            xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", "logout.php", true);
            xmlhttp.send();
        }
    </script>

</body>

</html>