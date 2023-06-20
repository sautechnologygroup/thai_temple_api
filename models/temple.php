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
}
