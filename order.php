<?php

$styles = ["order.css"];

require "./init.php";
require $inc . "header.inc.php";
include $inc . "navbar.inc.php";
require $func . "checkIsAValidDate.php";

if (isset($_GET['car_id'])) {
  $car_id = filter_var($_GET['car_id'], FILTER_SANITIZE_NUMBER_INT);
} else {
  header('Location: index.php');
  exit;
}

$cars = new Cars();
$car = $cars->getSingleCar($car_id);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $fullName = filter_var($_POST['fullName'], FILTER_SANITIZE_STRING);
  $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
  $phoneNumber = filter_var($_POST['phoneNumber'], FILTER_SANITIZE_STRING);
  $paymentMethod = filter_var($_POST['paymentMethod'], FILTER_SANITIZE_STRING);
  $pickupLocation = filter_var($_GET['pickupLocation'] ?? "", FILTER_SANITIZE_STRING);
  $dropOffLocation = filter_var($_GET['dropOffLocation'] ?? "", FILTER_SANITIZE_STRING);

  if (isset($_GET['pickupDate']) && isset($_GET['dropOffDate']) && checkIsAValidDate($_GET['pickupDate']) && checkIsAValidDate($_GET['dropOffDate'])) {
    $pickupDate = filter_var($_GET['pickupDate'], FILTER_SANITIZE_STRING);
    $dropOffDate = filter_var($_GET['dropOffDate'], FILTER_SANITIZE_STRING);
  } else {
    $pickupDate = date('Y-m-d');
    $dropOffDate = date("Y-m-d", strtotime('+1 day'));
  }

  $applications = new Applications();
  $bookCar = $applications->bookCar($fullName, $age, $phoneNumber, $car_id, $pickupLocation, $pickupDate, $dropOffLocation, $dropOffDate, $paymentMethod);
}
?>

<div class="pageContainer" id="pageContainer">
  <aside class="detailsSide">
    <div class="imageCard">
      <img src="<?php echo $car['car_image'] ?>" alt="<?php echo $car['car_name'] ?>">
    </div>
    <div class="textCard">
      <h2 class="carName"><?php echo $car['car_name'] ?></h2>
      <section class="carOptions">
        <ul>
          <li><span>Road Type</span>: <?php echo $car['road_type'] ?></li>
          <li><span>Car Color</span>: <?php echo $car['car_color'] ?></li>
          <li><span>Car Type</span>: <?php echo $car['car_type'] ?></li>
          <li><span>Renting Purpose</span>: <?php echo $car['renting_purpose'] ?></li>
          <li><span>Seats Number</span>: <?php echo $car['seats_number'] ?></li>
          <li><span>Gear Type</span>: <?php echo $car['gear_type'] ?></li>
          <li><span>Fuel Type</span>: <?php echo $car['fuel_type'] ?></li>
        </ul>
      </section>
    </div>
  </aside>
  <aside class="formSide">
    <h1 class="formTitle">Renting Application</h1>
    <?php
    if (isset($bookCar)) {
      if ($bookCar) { ?>
        <div class="alert success">Successfully Booked <?php echo $car['car_name'] ?></div>
      <?php
      } else {
      ?>
        <div class="alert error">Couldn't Book <?php echo $car['car_name'] ?></div>
    <?php
      }
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>?<?php echo $_SERVER['QUERY_STRING'] ?>" method="POST">
      <input type="text" placeholder="Full Name" name="fullName">
      <input type="number" placeholder="Age" min="0" name="age">
      <input type="text" placeholder="phone number" name="phoneNumber">
      <select name="paymentMethod">
        <option value="" disabled selected>Payment Method</option>
        <option value="cash">Cash</option>
        <option value="credit card">Credit Card</option>
      </select>
      <p class="totalPrice">Total:
        <?php
        if (isset($_GET['pickupDate']) && isset($_GET['dropOffDate']) && checkIsAValidDate($_GET['pickupDate']) && checkIsAValidDate($_GET['dropOffDate'])) {
          $pickupDate = strtotime(filter_var($_GET['pickupDate'], FILTER_SANITIZE_STRING));
          $dropOffDate = strtotime(filter_var($_GET['dropOffDate'], FILTER_SANITIZE_STRING));
          $dateDiff = round(($dropOffDate - $pickupDate) / (60 * 60 * 24));

          echo $dateDiff * $car['renting_cost'] . '$';
        } else {
          echo $car['renting_cost'] . '$';
        }
        ?>
      </p>
      <button type="submit">Book <?php echo $car['car_name'] ?></button>
    </form>
  </aside>
</div>
<?php
require $inc . "footer.inc.php";
?>