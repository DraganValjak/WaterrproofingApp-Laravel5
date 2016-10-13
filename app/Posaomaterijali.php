<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posaomaterijali extends Model
{
    
    
    public function posaomatmjesec(){
       return $this->hasMany('App\Posaomatmjesec');
   }
   
 public function getPosaoMaterijali($id) {
        $id = intval($id);
        $result = \DB::table('posaomaterijalis')
                ->join('materijals', 'posaomaterijalis.materijal_id', '=' , 'materijals.id')
                ->select('posaomaterijalis.*', 'materijals.*')
                ->where('posaomaterijalis.stavke_posla_id', '=', $id)
                ->get();
        return $result;
    }
}
