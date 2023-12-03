<?php

class Address {
    protected $streetNumber;
    protected $street;
    protected $city;
    protected $region;
    protected $country;
    protected $postalCode;

    public function __construct($streetNumber, $street, $city, $region, $country, $postalCode) {
        $this->streetNumber = $streetNumber;
        $this->street = $street;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
        $this->postalCode = $postalCode;
    }

    public function __toString() {
        return "Address[streetNumber={$this->streetNumber}, street={$this->street}, city={$this->city}, region={$this->region}, country={$this->country}, postalCode={$this->postalCode}]";
    }
}

?>