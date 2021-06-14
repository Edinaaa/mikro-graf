<?php

namespace App\Models;


class Cart
{
   public $items;
   public $totalqty=0;
   public $totalprc=0;

   public function __construct($oldCart){
       if($oldCart){
           $this->items=$oldCart->items;
           $this->totalqty=$oldCart->totalqty;
           $this->totalprc=$oldCart->totalprc;

       }
   }

   public function add($item, $id){
        $storeItem=['qty'=>0,'price'=>$item->cijena,'item'=>$item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storeItem=$this->items[$id];
            }
        }
        $storeItem['qty']++;
        $storeItem['price']=$item->cijena*$storeItem['qty'];
        $this->items[$id]=$storeItem;
        $this->totalqty++;
        $this->totalprc+= $item->cijena;
   }
   public function remove($item, $id){
    $storeItem=['qty'=>0,'price'=>$item->cijena,'item'=>$item];
    if($this->items){
        if(array_key_exists($id, $this->items)){
            $storeItem=$this->items[$id];
        }
    }
    $storeItem['qty']--;
    $storeItem['price']=$item->cijena*$storeItem['qty'];
    $this->items[$id]=$storeItem;
    $this->totalqty--;
    $this->totalprc-= $item->cijena;
    }

}
