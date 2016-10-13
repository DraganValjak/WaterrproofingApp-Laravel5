<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StavkePosla extends Model
{
    public function posaomaterijal(){
       return $this->hasMany('App\Posaomaterijali');
   }
   
   /**
     * Odnos mnogo prema jedan
     */
    public function stavka()
    {
        return $this->belongsTo('App\Evidencijaposlova');
    }
}
