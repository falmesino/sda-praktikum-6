<?php

  /**
   * ./3-penyimpanan-hasil-prediksi-model.php
   * Falmesino Abdul Hamid - 231232028
   */

  // Kelas Node untuk setiap element dalam BST
  class DataNode {
    public $id;
    public $left;
    public $right;

    public function __construct($id) {
      $this->id = $id;
      $this->left = null;
      $this->right = null;
    }
  }

  // Kelas untuk mengimplementasikan struktur Binary Search Tree
  class DataIndexTree {
    public $root;

    public function __construct(){
      $this->root = null;
    }

    // Fungsi untuk menambahkan ID data ke dalam tree
    public function addData($id) {
      $newNode = new DataNode($id);
      if ($this->root === null) {
        $this->root = $newNode;
      } else {
        $this->insertNode($this->root, $newNode);
      }
    }

    // Fungsi rekursif untuk menyisipkan node baru di tree
    private function insertNode($node, $newNode) {
      if ($newNode->id < $node->id) {
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

    // Fungsi untuk mencari ID data dalam tree
    public function searchData($id) {
      return $this->searchNode($this->root, $id);
    }

    // Fungsi rekursif untuk mencari node tertentu di dalam tree
    private function searchNode($node, $id) {
      if ($node === null) {
        return false; // Data tidak ditemukan
      }
      if ($id === $node->id) {
        return true; // Data ditemukan
      } elseif ($id < $node->id) {
        return $this->searchNode($node->left, $id);
      } else {
        return $this->searchNode($node->right, $id);
      }
    }
  }

  // Contoh penggunaan
  $dataTree = new DataIndexTree();

  // Menambahkan beberapa ID data
  $dataTree->addData(101);
  $dataTree->addData(205);
  $dataTree->addData(150);
  $dataTree->addData(89);

  // Mencari ID data
  $searchID = 150;
  if ($dataTree->searchData($searchID)) {
    echo "Data with ID $searchID found in the index.\n";
  } else {
    echo "Data with ID $searchID not found.\n";
  }

?>