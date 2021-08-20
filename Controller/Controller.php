<?php 

class Controller {
    public $manager;
    public static $entity;


    public function getManager() {
        return $this->manager;
    }
    public function setManager($manager) {
        $this->manager = $manager;
        return $this;
    }

    public function getEntity() {
        return $this->entity;
    }
    public function setEntity($entity) {
        $this->entity = $entity;
        return $this;
    }
}
//class user public static prop 