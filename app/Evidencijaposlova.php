<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidencijaposlova extends Model
{
    
   public function stavkePosla(){
       return $this->hasMany('App\StavkePosla');
   }
}
