<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;



class PdfRacunController extends Controller
{
  
    
    /**
     * Ispisujemo ponudu prema id evidencije
     * @param int $id id  evidencije
     * @return \Illuminate\Http\Response
     */
    public function ponuda($id)
    { 
       $id = intval($id);
       $evidencija = \App\Evidencijaposlova::findOrFail($id);
       $stavke = \App\StavkePosla::where('evidencijaposlova_id', '=', $evidencija->id)->get();
       return view('admin.pdfracuni.ponuda')->withEvidencija($evidencija)->with('stavke',$stavke);
    }
    
    /**
     * Ispisujemo stavke ponude prema id evidencije
     * @param int $id id evidencije
     * @return \Illuminate\Http\Response
     */
    public function stavke($id)
    {
        $id = intval($id);
        $evidencija = \App\Evidencijaposlova::findOrFail($id);
        $stavke = \App\StavkePosla::where('evidencijaposlova_id', '=', $evidencija->id)->get();
        return view('admin.pdfracuni.stavka')
                ->with('evidencija',$evidencija)
                ->with('stavke',$stavke);
    }
    
    /**
     * Ispisujemo stavke sa materijalima ponude prema id stavke
     * @param int $id id stavke
     * @return \Illuminate\Http\Response
     */
    public function stavkematerijali($ev_id, $id)
    {
        $ew_id = intval($ev_id);
        $id = intval($id);
       
        $evidencija = \App\Evidencijaposlova::findOrFail($ew_id);
        $stavka = \App\StavkePosla::find($id);
        $stavkeposlovi = \App\StavkePosla::find($stavka->id)->posaomaterijal;
        
       
        return view('admin.pdfracuni.stavkamaterijal')
                ->withEvidencija($evidencija)
                ->with('stavka', $stavka)
                ->with('stavkeposlovi', $stavkeposlovi);
    }
    
    
    public function rekapitaulacija($id)
    {
        return view('admin.pdfracuni.rekapitaulacija');
    }

    
        
    
}
