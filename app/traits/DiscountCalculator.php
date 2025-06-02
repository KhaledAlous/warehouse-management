<?php 
trait Discountcalculate{
    public function dicount($price){
        if($this->type =='percentage'){
          return $this->price - ( $this->price * $this ->discountPercentage/100);
        }
        
            $this->$price - $this ->dicountPercentage;
        
    }
}