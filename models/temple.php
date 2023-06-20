<?php

class Temple
{
    private $conn;

    public $templeId;
    public $templeName;
    public $templeAddress;
    public $templeLatitude;
    public $templeLongitude;
    public $templeMainImage;
    public $templeDetail;
    public $templeTell;
    public $districtId;
    public $status;
    public $verifiedBy;
    public $verifiedDate;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getTemplesWithinRadius($latitude, $longitude, $radius)
    {
        $query = "SELECT *, (6371 * 
                    acos(cos(radians(:latitude)) *
                    cos(radians(templeLatitude)) *
                    cos(radians(templeLongitude) - radians(:longitude)) +
                    sin(radians(:latitude)) *
                    sin(radians(templeLatitude)))
                ) AS distance
                FROM temple_tb
                HAVING distance <= :radius
                ORDER BY distance ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':latitude', $latitude);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->bindParam(':radius', $radius);
        $stmt->execute();

        return $stmt;
    }

    public function getTempleDetail()
    {
        $query = "SELECT * FROM temple_tb WHERE templeId = :templeId";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':templeId', $this->templeId);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->templeName = $row['templeName'];
        $this->templeAddress = $row['templeAddress'];
        $this->templeLatitude = $row['templeLatitude'];
        $this->templeLongitude = $row['templeLongitude'];
        $this->templeMainImage = $row['templeMainImage'];
        $this->templeDetail = $row['templeDetail'];
        $this->templeTell = $row['templeTell'];
        $this->districtId = $row['districtId'];
        $this->status = $row['status'];
        $this->verifiedBy = $row['verifiedBy'];
        $this->verifiedDate = $row['verifiedDate'];
    }
}
