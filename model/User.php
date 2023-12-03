<?php 

class User {
    protected $id;
    protected $userName;
    protected $email;
    protected $phoneNumber;
    protected $password;
    protected Address $address;
    protected $createDate;

    public function __construct($id, $userName, $email, $phoneNumber, $password, Address $address, $createDate) {
        $this->id = $id;
        $this->userName = $userName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->password = $password;
        $this->address = $address;
        $this->createDate = $createDate;
    }

    public function __get($atributo) {
        if($atributo != "password"){
            return $this->$atributo;
        } else {
            echo `No puedes obtener el atributo {$atributo}`;
        }
    }

    public function __toString() {
        $addressString = $this->address->__toString();
        return "User[id={$this->id}, userName={$this->userName}, email={$this->email}, phoneNumber={$this->phoneNumber}, address={$addressString}, createDate={$this->createDate}]";
    }
}

?>