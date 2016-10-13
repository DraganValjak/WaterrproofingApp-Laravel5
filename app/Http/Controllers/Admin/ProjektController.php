<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class ProjektController extends Controller
{
    
      
     /**
     * Ispisujemo ponudu prema id evidencije
     * @param int $id id  evidencije
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       $evidencijaposlova = \App\Evidencijaposlova::where('izdata_ponuda' , '=', '1')->get();
       return view('admin.projekt.index')->withEvidencijaposlova($evidencijaposlova);
    }
    
    /**
     * ispisujemo sve stavke projekta
     * @param int $id id  evidencije
     * @return type
     */
    public function stavke($id)
    {
         $id = intval($id);
        $posao_baza = \App\Evidencijaposlova::find($id);
        $posao = \App\Evidencijaposlova::find($id)->stavkePosla;
        
        return view('admin.projekt.stavke')
                ->with('posao_baza',$posao_baza)
                ->with('posao',$posao);
    }
    
    /**
     * Svi materijali jedne stavke posla
     * @param int $id id stavke polsa
     */
    public function materijali($id)
    {
        $id = intval($id);
        $stavka_posla = \App\StavkePosla::find($id);
        $posaomaterijal = \App\StavkePosla::find($id)->posaomaterijal;
        //$posao_materijal = new Posaomaterijali();
        //$posaomaterijal = $posao_materijal->getPosaoMaterijali($id);
        $projekt = \App\Evidencijaposlova::find($stavka_posla->evidencijaposlova_id);
        // lista materijala
         $listamaterijala = \App\Materijal::lists('naziv_materijala', 'id');

        return view('admin.projekt.materijali')
                ->with('posaomaterijal',$posaomaterijal)
                ->with('projekt',$projekt)
                ->with('listamaterijala',$listamaterijala)
                ->with('stavka_posla',$stavka_posla);
    }
    
    
    /**
     * Otvaranje forme za promene u količinam ai izračunu materijala
     * @param int $id id posaomaterijala
     * @return type
     */
    public function promjene($id)
    {
        
        $posaomaterijal = \App\Posaomaterijali::findOrFail($id);
        
        $stavka_posla = \App\StavkePosla::find($posaomaterijal->stavke_posla_id);
       
        $projekt = \App\Evidencijaposlova::find($stavka_posla->evidencijaposlova_id);
        
        $posaomatmjesec = \App\Posaomaterijali::find($id)->posaomatmjesec;
       
        return view('admin.projekt.promjene')
                ->with("projekt", $projekt)
                ->with("stavka_posla", $stavka_posla)
                ->with("posaomaterijal",$posaomaterijal)
                ->with("posaomatmjesec", $posaomatmjesec);
    }
}
