<?php 

class Employee {
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $title;

    public function __construct($id, $firstName, $lastName, $title) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->title = $title;
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