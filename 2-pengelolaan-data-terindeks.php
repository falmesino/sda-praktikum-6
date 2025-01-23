<?php

  /**
   * ./2-pengelolaan-data-terindeks.php
   * Falmesino Abdul Hamid - 231232028
   */

  // Kelas Node untuk merepresentasikan setiap node di BST 
  class SensorNode {
    public $sensorID;
    public $temperature;
    public $left;
    public $right;

    public function __construct($sensorID, $temperature) {
      $this->sensorID = $sensorID;
      $this->temperature = $temperature;
      $this->left = null;
      $this->right = null;
    }
  }

  // Kelas untuk Binary Search Tree untuk data sensor
  class SensorDataTree {
    public $root;

    public function __construct() {
      $this->root = null;
    }

    // Fungsi untuk menambahkan data sensor ke dalam BST
    public function addSensorData($sensorID, $temperature) {
      $newNode = new SensorNode($sensorID, $temperature);
      if ($this->root === null) {
        $this->root = $newNode;
      } else {
        $this->insertNode($this->root, $newNode);
      }
    }

    // Fungsi rekursif untuk menyisipkan node baru di tree
    private function insertNode($node, $newNode) {
      if ($newNode->temperature < $node->temperature) {
        if ($node->left === null) {
          $node->left = $newNode;
        } else {
          $this->insertNode($node->left, $newNode);
        }
      } else {
        if ($node->right === null) {
          $node->right = $newNode;
        } else {
          $this->insertNode($node->right, $newNode);
        }
      }
    }

    // Fungsi untuk mencari data sensor berdasarkan temperaature
    public function searchByTemperature($temperature) {
      return $this->searchNode($this->root, $temperature);
    }

    // Fungsi rekursif untuk mencari node berdasarakan temperature
    private function searchNode($node, $temperature) {
      if ($node === null) {
        return null; // Data tidak ditemukan
      }
      if ($temperature === $node->temperature) {
        return $node; // Data ditemukan
      } elseif ($temperature < $node->temperature) {
        return $this->searchNode($node->left, $temperature);
      } else {
        return $this->searchNode($node->right, $temperature);
      }
    }
  }

  // Contoh penggunaan
  $sensorTree = new SensorDataTree();

  // Menambahkan beberapa data sensor
  $sensorTree->addSensorData(101, 22.5);
  $sensorTree->addSensorData(102, 19.8);
  $sensorTree->addSensorData(103, 25.1);
  $sensorTree->addSensorData(104, 23.4);

  // Mencari data sensor berdasarkan temperature
  $searchTemp = 23.4;
  $foundNode = $sensorTree->searchByTemperature($searchTemp);
  if ($foundNode !== null) {
    echo "Sensor with ID " . $foundNode->sensorID . " has a temperature of " . $foundNode->temperature . "C.\n";
  } else {
    echo "No sensor data found for temperature . " . $searchTemp . "C.\n";
  }

?>