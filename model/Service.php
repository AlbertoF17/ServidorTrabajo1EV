<?php 

class Service {
    protected $id;
    protected $categoryId;
    protected $name;
    protected $price;
    protected $description;
    protected $picture;

    public function __construct($id, $categoryId, $name, $price, $description, $picture) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->picture = $picture;
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