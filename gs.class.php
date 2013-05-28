<?php
class GS extends User {
  public function __construct($i) {
    User::__construct($i);
  }

  public function getID() {
    return User::getID();
  }

  public function get_applicant() {
    return User::get_user();
  }
}
?>