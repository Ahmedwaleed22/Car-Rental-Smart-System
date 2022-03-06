<?php

$styles = ["homepage.css"];

require "./init.php";
require $inc . "header.inc.php";
require $inc . "navbar.inc.php";
?>

<div class="pageContainer">
  <div class="content">
    <h1>Welcome To RENTAL SMART CAR</h1>
    <div class="filtersContainer">
      <form action="options.php" method="POST">
        <div class="input-group">
          <label for="pickupLocation">Pick-Up Location</label>
          <input name="pickupLocation" id="pickupLocation" type="text" placeholder="Pick-Up Location">
        </div>
        <div class="input-group">
          <label for="pickupDate">Pick-Up Date</label>
          <input name="pickupDate" id="pickupDate" type="date" placeholder="Pick-Up Date">
        </div>
        <div class="input-group">
          <label for="dropOffLocation">Drop-Off Location</label>
          <input name="dropOffLocation" id="dropOffLocation" type="text" placeholder="Drop-Off Location">
        </div>
        <div class="input-group">
          <label for="dropOffDate">Drop-Off Date</label>
          <input name="dropOffDate" id="dropOffDate" type="date" placeholder="Drop-Off Date">
        </div>
        <button class="searchButton">Search</button>
      </form>
    </div>
  </div>
</div>

<?php
require $inc . "footer.inc.php";
?>