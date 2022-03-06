<?php

function checkIsAValidDate($myDateString)
{
  return (bool)strtotime($myDateString);
}
