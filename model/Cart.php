<?php 

class Cart {
    protected $id;
    protected array $products;
    protected array $services;
    protected $totalPrice;
    protected $date;

    public function __construct($id, array $products, array $services, $totalPrice, $date) {
        $this->id = $id;
        $this->products = $products;
        $this->services = $services;
        $this->totalPrice = $totalPrice;
        $this->date = $date;
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