<?php 
class Introduction{
    // database connection and table name
    private $conn;

    // object properties
    public $message;

    public $introId;
    public $introTempleImage;
    public $introTempleName;
    public $introTempleDetail;
    public $geographies;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all introduction
    public function getAllIntroduction(){
        // select all query
        $query = "SELECT * FROM introduction_tb";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create new introduction
    public function createIntroduction() {
        // insert query
        $query = "INSERT INTO introduction_tb 
            SET introTempleImage = :introTempleImage,
                introTempleName = :introTempleName,
                introTempleDetail = :introTempleDetail,
                geographies = :geographies";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize input values
        $this->introTempleImage = htmlspecialchars(strip_tags($this->introTempleImage));
        $this->introTempleName = htmlspecialchars(strip_tags($this->introTempleName));
        $this->introTempleDetail = htmlspecialchars(strip_tags($this->introTempleDetail));
        $this->geographies = htmlspecialchars(strip_tags($this->geographies));

        // bind values
        $stmt->bindParam(":introTempleImage", $this->introTempleImage);
        $stmt->bindParam(":introTempleName", $this->introTempleName);
        $stmt->bindParam(":introTempleDetail", $this->introTempleDetail);
        $stmt->bindParam(":geographies", $this->geographies);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // getintroById
    public function getIntroductionById() {
        // select all query
        $query = "SELECT * FROM introduction_tb WHERE introId = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(1, $this->introId);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // update introduction
    public function updateIntroduction() {
        // update query
        $query = "UPDATE introduction_tb 
            SET introTempleImage = :introTempleImage,
                introTempleName = :introTempleName,
                introTempleDetail = :introTempleDetail,
                geographies = :geographies
            WHERE introId = :introId";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize input values
        $this->introTempleImage = htmlspecialchars(strip_tags($this->introTempleImage));
        $this->introTempleName = htmlspecialchars(strip_tags($this->introTempleName));
        $this->introTempleDetail = htmlspecialchars(strip_tags($this->introTempleDetail));
        $this->geographies = htmlspecialchars(strip_tags($this->geographies));
        $this->introId = htmlspecialchars(strip_tags($this->introId));

        // bind values
        $stmt->bindParam(":introTempleImage", $this->introTempleImage);
        $stmt->bindParam(":introTempleName", $this->introTempleName);
        $stmt->bindParam(":introTempleDetail", $this->introTempleDetail);
        $stmt->bindParam(":geographies", $this->geographies);
        $stmt->bindParam(":introId", $this->introId);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // delete introduction
    public function deleteIntroduction() {
        // delete query
        $query = "DELETE FROM introduction_tb WHERE introId = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize input values
        $this->introId = htmlspecialchars(strip_tags($this->introId));

        // bind values
        $stmt->bindParam(1, $this->introId);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
