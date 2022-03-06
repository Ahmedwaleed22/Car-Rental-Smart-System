<?php

class Cars extends Dbh
{
  public function getMatchings($roadType, $carType, $purpose, $seats, $gear, $fuel)
  {
    $data = [];
    $sql = "SELECT * FROM cars";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

    while ($rows = $stmt->fetchAll()) {
      foreach ($rows as $row) {
        if (in_array($row['road_type'], $roadType) && in_array($row['car_type'], $carType) && in_array($row['renting_purpose'], $purpose) && in_array($row['gear_type'], $gear) && in_array($row['fuel_type'], $fuel)) {
          if (!in_array($row['seats_number'], [4, 5, 6]) && in_array("Others", $seats)) {
            array_push($data, $row);
          } else if (in_array($row['seats_number'], $seats)) {
            array_push($data, $row);
          }
        }
      }

      return $data;
    }
  }

  public function getSingleCar($car_id)
  {
    $sql = "SELECT * FROM cars WHERE ID = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$car_id]);

    return $stmt->fetch();
  }
}
