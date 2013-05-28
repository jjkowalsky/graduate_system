<?php

class Applicant extends User {

  public function __construct($i) {
    User::__construct($i);
  }

  public function getID() {
    return User::getID();
  }

  public function get_applicant() {
    return User::get_user();
  }

  public function get_status() {
    $status_query = "SELECT `USERS`.`Fname`, `USERS`.`Lname`, `APPLICANT`.*
    FROM APPLICANT, USERS
    WHERE (`APPLICANT`.`applicantID` = `USERS`.`userID`)
    AND (`APPLICANT`.`applicantID` = '{$this->getID()}')";
    return mysql_query($status_query);
  }

  public function get_application() {
    $application_query = "SELECT `APPLICATION`.*, `LETTER`.*
    FROM APPLICATION, LETTER
    WHERE (`APPLICATION`.`applicantID` = `LETTER`.`applicantID`)
    AND (`APPLICATION`.`applicantID` = '{$this->getID()}')";
    return mysql_query($application_query);
  }

  public function get_letters() {
    $letters_query = "SELECT `APPLICATION`.`applicantID`, `LETTER`.`applicantID`
    FROM APPLICATION, LETTER
    WHERE (`APPLICATION`.`applicantID` = `LETTER`.`applicantID`)
    AND (`APPLICATION`.`applicantID` = '{$this->getID()}')";
    return mysql_query($letters_query);
  }

  public function print_application() {
    echo "printing application...not";
    echo "<br>";
  }

  public function print_letters() {
    echo "printing letters...not";
    echo "<br>";
  }

  public function print_application_review() {
    echo "printing application review...not";
    echo "<br>";
  }
}
?>