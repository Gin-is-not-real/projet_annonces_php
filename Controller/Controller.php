<?php 

class Controller {
    public $manager;
    public static $ENTITY;
    //relation = [table, strangerKey, key]
    public $relations = [];


    public function getManager() {
        return $this->manager;
    }
    public function setManager($manager) {
        $this->manager = $manager;
        return $this;
    }

    public function getEntity() {
        return $this->ENTITY;
    }
    public function setEntity($ENTITY) {
        $this->ENTITY = $ENTITY;
        return $this;
    }

    public function getRelations() {
        return $this->relations;
    }
    public function pushRelation($table, $strangerKey, $key) {
        $this->relations[$table] = ['table' => $table, 'strangerKey' => $strangerKey, 'key' => $key];
    }
}
//class user public static prop 