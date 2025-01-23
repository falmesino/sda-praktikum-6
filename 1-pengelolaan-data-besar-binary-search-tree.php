<?php

  /**
   * ./1-pengelolaan-data-besar-binary-search-tree.php.php
   * Falmesino Abdul Hamid - 231232028
   */

  // Kelas Node untuk merepresentasikan setiap node di BST
  class LogNode {
    public $timestamp;
    public $message;
    public $left;
    public $right;

    public function __construct($timestamp, $message) {
      $this->timestamp = $timestamp;
      $this->message = $message;
      $this->left = null;
      $this->right = null;
    }
  }

  // Kelas untuk struktur Binary Search Tree
  class LogTree {
    public $root;

    public function __construct() {
      $this->root = null;
    }

    // Fungsi untuk menambahkan data log ke dalam BST
    public function addLog($timestamp, $message) {
      $newNode = new LogNode($timestamp, $message);
      if ($this->root === null) {
        $this->root = $newNode;
      } else {
        $this->insertNode($this->root, $newNode);
      }
    }

    // Fungsi rekursif untuk menyisipkan node baru di tree
    private function insertNode($node, $newNode) {
      if ($newNode->timestamp < $node->timestamp) {
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

    // Fungsi untuk mencari log berdasarkan timestamp
    public function searchLog($timestamp) {
      return $this->searchNode($this->root, $timestamp);
    }

    // Fungsi rekursif untuk mencari node berdasarkan timestamp
    private function searchNode($node, $timestamp) {
      if ($node === null) {
        return null; // Data tidak ditemukan
      }
      if ($timestamp === $node->timestamp) {
        return $node; // Data ditemukan
      } elseif ($timestamp < $node->timestamp) {
        return $this->searchNode($node->left, $timestamp);
      } else {
        return $this->searchNode($node->right, $timestamp);
      }
    }
  }

  // Contoh Penggunaan
  $logTree = new LogTree();

  // Menambahkan beberapa data log
  $logTree->addLog(1618300000, "Server 1 started");
  $logTree->addLog(1618300500, "Server 1 started");
  $logTree->addLog(1618301000, "Database connection established");
  $logTree->addLog(1618302000, "User login attempt");

  // Mencari log berdasarkan timestamp
  $searchTime = 1618300500; // 161300500
  $foundLog = $logTree->searchLog($searchTime);

  if ($foundLog !== null) {
    echo "Log found: " . $foundLog->message . " at " . $foundLog->timestamp . ".\n";
  } else {
    echo "No log found for timestamp " . $searchTime . ".\n";
  }

?>