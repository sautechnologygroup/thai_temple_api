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

    public function getAllTemples()
    {
        $query = "SELECT * FROM temple_tb";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


}
