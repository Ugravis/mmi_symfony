<?php
  namespace App\Service;

  class JsonService {
    public function read(string $File): array {
      $jsonFile = file_get_contents($File);
      $jsonArray = json_decode($jsonFile);
      
      return $jsonArray;
    }
  }