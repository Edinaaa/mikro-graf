<?php

namespace App\Models;


class SelektovaniMaterijali
{
   public $items;


   public function __construct($oldCart){
       if($oldCart!=null){
           $this->items=$oldCart->items;
           

       }
   }

   public function add($item, $id){
        $storeItem=$item;
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storeItem=$this->items[$id];
            }
        }
      
        $this->items[$id]=$storeItem;
     
   }
   public function remove($id){
    if($this->items){
        if(array_key_exists($id, $this->items)){
            unset($this->items[$id]);

        }
    }
   
  
    }

}
