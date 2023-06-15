<?php
class Temple {
    private $conn;
    
    public $templeId;
    public $templeName;
    public $templeAddress;
    public $latitude;
    public $longitude;
    public $templeImage;
    public $templeDetail;
    public $provinceId;
    public $districtId;
    public $subdistrictId;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllTemples() {
        $query = "SELECT * FROM temple_tb";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}



