<?php

class Applications extends Dbh
{
  public function bookCar($fullName, $age, $phoneNumber, $car_id, $pickupLocation, $pickupDate, $dropOffLocation, $dropOffDate, $paymentMethod)
  {
    $sql = "INSERT INTO applications (full_name, age, phone_number, car_id, pickup_location, pickup_date, dropoff_location, dropoff_date, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$fullName, $age, $phoneNumber, $car_id, $pickupLocation, $pickupDate, $dropOffLocation, $dropOffDate, $paymentMethod]);

    return $stmt->rowCount() ? true : false;
  }
}
