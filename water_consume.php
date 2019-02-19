<?php

class water_consume {

    public created_at;
    public input_water;
    public user_id;
    public type;

    public function __construct($created_at, $input_water, $user_id, $type){
           $this->created_at = $created_at;
           $this->input_water = $input_water;
           $this->user_id = $user_id;
           $this->$type = $type;
    } 
}
?>