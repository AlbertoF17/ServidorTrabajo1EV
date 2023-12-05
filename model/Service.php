<?php 

class Service {
    protected $id;
    protected $categoryId;
    protected $name;
    protected $price;
    protected $description;
    protected $image;

    public function __construct($id, $categoryId, $name, $price, $description, $image) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
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