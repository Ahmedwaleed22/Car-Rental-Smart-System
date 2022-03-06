<?php

$styles = ["options.css"];

require "./init.php";
require $inc . "header.inc.php";

if (!$_SERVER['REQUEST_METHOD'] == "POST") {
  header('Location: index.php');
  exit;
}

$pickupLocation = filter_var($_POST['pickupLocation'], FILTER_SANITIZE_STRING);
$pickupDate = filter_var($_POST['pickupDate'], FILTER_SANITIZE_STRING);
$dropOffLocation = filter_var($_POST['dropOffLocation'], FILTER_SANITIZE_STRING);
$dropOffDate = filter_var($_POST['dropOffDate'], FILTER_SANITIZE_STRING);
?>

<div class="pageContainer" id="pageContainer">
  <?php
  include $inc . "navbar.inc.php";
  ?>

  <section class="questionsContainer">
    <form action="matchings.php" method="POST">
      <input type="hidden" name="pickupLocation" value="<?php echo $pickupLocation ?>">
      <input type="hidden" name="pickupDate" value="<?php echo $pickupDate ?>">
      <input type="hidden" name="dropOffLocation" value="<?php echo $dropOffLocation ?>">
      <input type="hidden" name="dropOffDate" value="<?php echo $dropOffDate ?>">
      <div class="questionCard">
        <h2 class="question">1. Where you will be driving the car?</h2>
        <section class="options">
          <div class="option">
            <input type="checkbox" id="Highway" name="roadType[]" value="Highway">
            <label for="Highway">Highway</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Main-Roads" name="roadType[]" value="Main Roads">
            <label for="Main-Roads">Main Roads</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Village-Streets" name="roadType[]" value="Village Streets">
            <label for="Village-Streets">Village Streets</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Others" name="roadType[]" value="Others">
            <label for="Others">Others</label>
          </div>
        </section>
      </div>

      <div class="questionCard">
        <h2 class="question">2. Which car type you would prefer?</h2>
        <section class="options">
          <div class="option">
            <input type="checkbox" id="Small" name="carType[]" value="Small">
            <label for="Small">Small</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Family" name="carType[]" value="Family">
            <label for="Family">Family</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Sports" name="carType[]" value="Sports">
            <label for="Sports">Sports</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Luxury" name="carType[]" value="Luxury">
            <label for="Luxury">Luxury</label>
          </div>
        </section>
      </div>

      <div class="questionCard">
        <h2 class="question">3. What is the purpose of renting the car? </h2>
        <section class="options">
          <div class="option">
            <input type="checkbox" id="Work" name="purpose[]" value="Work">
            <label for="Work">Work</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Trip" name="purpose[]" value="Trip">
            <label for="Trip">Trip</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Tourism" name="purpose[]" value="Tourism">
            <label for="Tourism">Tourism</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Purpose-Others" name="purpose[]" value="Others">
            <label for="Purpose-Others">Others</label>
          </div>
        </section>
      </div>

      <div class="questionCard">
        <h2 class="question">4. How many seats do you prefer</h2>
        <section class="options">
          <div class="option">
            <input type="checkbox" id="4-Seats" name="seats[]" value="4">
            <label for="4-Seats">4 Seats</label>
          </div>
          <div class="option">
            <input type="checkbox" id="5-Seats" name="seats[]" value="5">
            <label for="5-Seats">5 Seats</label>
          </div>
          <div class="option">
            <input type="checkbox" id="6-Seats" name="seats[]" value="6">
            <label for="6-Seats">6 Seats</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Seats-Others" name="seats[]" value="Others">
            <label for="Seats-Others">Others</label>
          </div>
        </section>
      </div>

      <div class="questionCard">
        <h2 class="question">5. Which gear you prefer to drive?</h2>
        <section class="options">
          <div class="option">
            <input type="checkbox" id="Automatic" name="gear[]" value="Automatic">
            <label for="Automatic">Automatic</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Manual" name="gear[]" value="Manual">
            <label for="Manual">Manual</label>
          </div>
        </section>
      </div>

      <div class="questionCard">
        <h2 class="question">6. What is fuel type?</h2>
        <section class="options">
          <div class="option">
            <input type="checkbox" id="Diesel" name="fuel[]" value="Diesel">
            <label for="Diesel">Diesel</label>
          </div>
          <div class="option">
            <input type="checkbox" id="Gas-oil" name="fuel[]" value="Gas Oil">
            <label for="Gas-oil">Gas oil</label>
          </div>
        </section>
      </div>

      <button class="searchMatchingsButton" type="submit">Search Matchings</button>
    </form>
  </section>
</div>

<?php
require $inc . "footer.inc.php";
?>