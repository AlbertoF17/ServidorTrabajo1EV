<?php 

class Address {
    protected $apartmentNumber;
    protected $street;
    protected $city;
    protected $region;
    protected $country;
    protected $postalCode;

    public function __construct($apartmentNumber, $street, $city, $region, $country, $postalCode) {
        $this->apartmentNumber = $apartmentNumber;
        $this->street = $street;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
        $this->postalCode = $postalCode;
    }

    public function __get($atributo) {
        if($atributo != "password"){
            return $this->$atributo;
        } else {
            echo `No puedes obtener el atributo {$atributo}`;
        }
    }
}

?>