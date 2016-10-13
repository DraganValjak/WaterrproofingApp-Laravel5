<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\MaterijalFormUpdateRequest;
use App\Http\Requests\MaterijalFormRequest;
use App\Http\Requests\PosaomatreijalCreateRequest;
use App\Http\Controllers\Controller;

use App\Posaomaterijali;

class PosaoMaterijalController extends Controller
{
    protected  $table = 'posaomaterijalis';
    protected $fields = [
        'stavke_posla_id' => '',
        'naziv_materijala' => '',
        'mjerna_jedinica' => '',
        'cijena_sa_popustom' => '',
        'potrosnja_mat' => '',
        'materijal' => '',
        'kalkul_sat' => '',
        'norma_sat' => '',
        'rad' => '',
        'cijena_po_jm' => '',
        'ucinak_m2_sat' => '',
        'minuta' => '',
        'troskovi_gradilista' => '',
        'kalkulativna_cijena_ukupno'=> '',
        'created_at' => '',
        
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MaterijalFormRequest $request)
    {
        
        $posaomaterijal = new Posaomaterijali();
        
        $materijal_donos = \App\Materijal::find($request->input('materijal_id'));
        
        $posaomaterijal->stavke_posla_id = $request->input('id_stavke');
        $posaomaterijal->naziv_materijala  = $materijal_donos->naziv_materijala;
        $posaomaterijal->mjerna_jedinica = $materijal_donos->mjerna_jedinica;
        $posaomaterijal->cijena_sa_popustom  = $materijal_donos->cijena_sa_popustom;
        $posaomaterijal->potrosnja_mat = $request->input('potrosnja_mat');
        $posaomaterijal->kalkul_sat = $request->input('kalkul_sat');
        $posaomaterijal->minuta = $request->input('minuta');
        $posaomaterijal->norma_sat = $request->input('norma_sat');
        // materijal = cijena materijala * potrošnja
        $posaomaterijal->materijal = $materijal_donos->cijena_materijala_po_jedinici  * $posaomaterijal->potrosnja_mat;
      
        // rad = kalku_sat  * norma_sat
        $posaomaterijal->rad = $posaomaterijal->kalkul_sat * $posaomaterijal->norma_sat;
        // cijena po jed. metru = materijal * rad
        $posaomaterijal->cijena_po_jm = $posaomaterijal->materijal * $posaomaterijal->rad; 
        // ucinak m2/sat = 60/ minuta
        $posaomaterijal->ucinak_m2_sat = 60 / $posaomaterijal->minuta;
         
        $posaomaterijal->save();
        
         /**
          * Izračunavamo cijenu posla i ukupnu cijenu kod svake promjene u tablici posaomaterijali
          */
        $this->_calculate($posaomaterijal->stavke_posla_id);
        
        return redirect("admin/posaomaterijal/show/$posaomaterijal->stavke_posla_id")->withSuccess("Materijal je dodan.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
      
       
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = intval($id);
        $stavka_posla = \App\StavkePosla::find($id);
        $posaomaterijal = \App\StavkePosla::find($id)->posaomaterijal;
        //$posao_materijal = new Posaomaterijali();
        //$posaomaterijal = $posao_materijal->getPosaoMaterijali($id);
        $projekt = \App\Evidencijaposlova::find($stavka_posla->evidencijaposlova_id);
        // lista materijala
         $listamaterijala = \App\Materijal::lists('naziv_materijala', 'id');

        return view('admin.posaomaterijal.show')
                ->with('posaomaterijal',$posaomaterijal)
                ->with('projekt',$projekt)
                ->with('listamaterijala',$listamaterijala)
                ->with('stavka_posla',$stavka_posla);
                
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Posaomaterijali::where('id', '=',$id)->get();
        
        $posmat = $result[0];
       
        $data = ['id' => $id]; // u array $data dodajemo $id 
        foreach(array_keys($this->fields)  as $field){
               $data[$field] = old($field, $posmat->$field);
        }
       
     $stavka = \App\StavkePosla::find($posmat->stavke_posla_id);
     $posao_baza = \App\Evidencijaposlova::find($stavka->evidencijaposlova_id);
        
        return view('admin.posaomaterijal.edit', $data)
                ->with('stavka', $stavka)
                ->with('posao_baza', $posao_baza);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterijalFormUpdateRequest $request, $id)
    {
        
        $result[0] = Posaomaterijali::where('id', '=',$id)->get();
       
        $posaomaterijal = $result[0];
        
        $posaomaterijal->stavke_posla_id = $request->input('stavke_posla_id');
        $posaomaterijal->materijal_id = $request->input('materijal_id');
        $posaomaterijal->potrošnja_mat = $request->input('potrošnja_mat');
        $posaomaterijal->kalkul_sat = $request->input('kalkul_sat');
        $posaomaterijal->minuta = $request->input('minuta');
        // materijal = cijena materijala * potrošnja
        $posaomaterijal->materijal = $materijal_donos->cijena_materijala_po_jedinici  * $request->input('potrošnja_mat');
        // rad = kalku_sat  * norma_sat
        $posaomaterijal->rad = $request->input('kalkul_sat') * $request->input('norma_sat');
        // norma sat = rad /kalku sat
        $posaomaterijal->norma_sat = $posaomaterijal->rad / $request->input('kalkul_sat');
        // cijena po jed. metru = materijal * rad
        $posaomaterijal->cijena_po_jm = $posaomaterijal->materijal * $posaomaterijal->rad; 
        // ucinak m2/sat = 60/ minuta
        $posaomaterijal->ucinak_m2_sat = 60 / $request->input('minuta');
        
        $posaomaterijal->save();
        
        
        
        return redirect("admin/posaomaterijal/edit/$id")->withSuccess("Promjene su spremljene");
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
         * Moramo pronaci id stavke da bi mogliobaviti novu kalkulaciju cijena
         */
        $posaomaterijali = Posaomaterijali::findOrFail($id);
        $posaomaterijali::where('id', '=',$posaomaterijali->id)->delete();
        
        /**
          * Izračunavamo cijenu posla i ukupnu cijenu kod svake promjene u tablici posaomaterijali
          */
        $this->_calculate($posaomaterijali->stavke_posla_id);
         
         return back()->withSuccess("Materijal je obrisan.");
    }
    
    
    /**
     * Izračunavamo cijenu posla i ukupnu cijenu kod svake promjene u tablici posaomaterijali
     * @param int $id  id stavke posla
     */
    private function _calculate($id)
    {
         $svi_poslovi_stavke = \App\StavkePosla::find($id)->posaomaterijal;
         $cijena_posla = 0;
         $ukupno_materijal = 0;
         foreach($svi_poslovi_stavke as $ps){
             $cijena_posla +=  $ps->rad;
             $ukupno_materijal += $ps->materijal;
         }
        
          $poslovi_stavke = new \App\StavkePosla();
          
         $poslovi_stavke::where('id', '=', $id)->update(array(
            'cijena_posla' => $cijena_posla,
            'ukupna_cijena' => $cijena_posla + $ukupno_materijal
        ));

    }
}
