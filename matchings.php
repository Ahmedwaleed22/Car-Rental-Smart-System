<?php

$pickupLocation = filter_var($_POST['pickupLocation'] ?? "", FILTER_SANITIZE_STRING);
$pickupDate = filter_var($_POST['pickupDate'] ?? "", FILTER_SANITIZE_STRING);
$dropOffLocation = filter_var($_POST['dropOffLocation'] ?? "", FILTER_SANITIZE_STRING);
$dropOffDate = filter_var($_POST['dropOffDate'] ?? "", FILTER_SANITIZE_STRING);

if (empty($_POST['roadType'])) {
  $roadType = ['Highway', 'Main Roads', 'Village Streets', 'Others'];
} else {
  $roadType = filter_var_array($_POST['roadType']);
}

if (empty($_POST['carType'])) {
  $carType = ['Small', 'Family', 'Sports', 'Luxury'];
} else {
  $carType = filter_var_array($_POST['carType']);
}

if (empty($_POST['purpose'])) {
  $purpose = ['Work', 'Trip', 'Tourism', 'Others'];
} else {
  $purpose = filter_var_array($_POST['purpose']);
}

if (empty($_POST['seats'])) {
  $seats = [4, 5, 6, "Others"];
} else {
  $seats = filter_var_array($_POST['seats']);
}

if (empty($_POST['gear'])) {
  $gear = ['Automatic', 'Manual'];
} else {
  $gear = filter_var_array($_POST['gear']);
}

if (empty($_POST['fuel'])) {
  $fuel = ['Diesel', 'Gas Oil'];
} else {
  $fuel = filter_var_array($_POST['fuel']);
}

$styles = ["matchings.css"];

require "init.php";
require $inc . "header.inc.php";
include $inc . "navbar.inc.php";

$cars = new Cars();
$matchings = $cars->getMatchings($roadType, $carType, $purpose, $seats, $gear, $fuel);

?>

<div class="pageContainer">

  <div class="matchingsContainer">
    <?php
    foreach ($matchings as $car) {
    ?>
      <div class="carCard">
        <div class="imageCard">
          <img src="<?php echo $car['car_image'] ?>" alt="<?php echo $car['car_name'] ?> Image">
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
          <a class="chooseCarButton" href="order.php?car_id=<?php echo $car['ID'] ?>&pickupLocation=<?php echo $pickupLocation ?>&pickupDate=<?php echo $pickupDate ?>&dropOffLocation=<?php echo $dropOffLocation ?>&dropOffDate=<?php echo $dropOffDate ?>">Choose Car</a>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>

<?php
require $inc . "footer.inc.php";
?>