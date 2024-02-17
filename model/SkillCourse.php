<?php 

class SkillCourse {
    protected $id;
    protected $type;
    protected $categoryId;
    protected $name;
    protected $price;
    protected $description;
    protected $image;

    public function __construct($id, $type, $categoryId, $name, $price, $description, $image) {
        $this->id = $id;
        $this->type = "Skill Course";
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