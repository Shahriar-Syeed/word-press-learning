<?php

class GetPets
{
  function __construct()
  {
    global $wpdb;
    $tablename = $wpdb->prefix . 'pets';
    $ourQuery = $wpdb->prepare("SELECT * FROM $tablename WHERE species = %s LIMIT 100", array($_GET['species']));
    $this->pets = $wpdb->get_results($ourQuery);
  }
}
