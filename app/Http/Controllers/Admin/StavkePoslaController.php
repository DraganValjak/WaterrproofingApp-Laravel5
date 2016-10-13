<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StavkeposlovaCreateRequest;
use App\Http\Requests\StavkeposlovaUpdateRequest;
use App\StavkePosla;

class StavkePoslaController extends Controller
{
   
      protected $table = 'stavke_poslas';
     
        protected $fields = array(
        'evidencijaposlova_id' => '', 
        'broj_stavke'  => '',
        'opis_radova'   => '',
        'cijena_posla'  => '',
        'ukupna_cijena'  => '', 
        'created_at' => '',
    );
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StavkeposlovaCreateRequest $request, $id)
    {
        
        $id = intval($id);
        $zadnji_broj = 0;
        // kojem polu pripada
        $evidencija = \App\Evidencijaposlova::find($id);
        // trebamo pronaci zadnju stvaku posl akako bismo joj dodali 1, tako da svaka stavk ima broj
        
        $zadnji = \App\Evidencijaposlova::find($id)->stavkePosla()->orderBy('broj_stavke', 'DESC')->first();
        // ako je prva stavka posla treba joj dodati, redni broj 1 jer $zadnji->broj_stavke je null i to radi grešku
        if( ! count($zadnji) ){
            $zadnji_broj =  1;
        }else{
            $zadnji_broj = $zadnji->broj_stavke + 1;
        }
        
        
        $stavke = new StavkePosla();

        $stavke->evidencijaposlova_id = $id;
        $stavke->broj_stavke = $zadnji_broj;
        $stavke->opis_radova = $request->input('opis_radova');
        $stavke->cijena_posla = '';
        $stavke->ukupna_cijena = '';

        $stavke->save();
        
        
         /**
        * Izračunavamo cijenu posla  kod svake promjene u tablici stavkeposla
        * @param int $id  id evidencije
        */
         $this-> _calculate($stavke->evidencijaposlova_id);

        return redirect("admin/stavkeposla/show/$id")->withSuccess("Posao  za '$evidencija->narucitelj' je dodan.");
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
        $posao_baza = \App\Evidencijaposlova::find($id);
        $posao = \App\Evidencijaposlova::find($id)->stavkePosla;
        
        return view('admin.stavkeposla.index')
                ->with('posao_baza',$posao_baza)
                ->with('posao',$posao);
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posao = StavkePosla::findOrFail($id);
        $data = ['id' => $id]; // u array $data dodajemo $id 
        foreach(array_keys($this->fields)  as $field){
               $data[$field] = old($field, $posao->$field);
        }
        
        $posao_baza = \App\Evidencijaposlova::find($posao->evidencijaposlova_id);
        
        return view('admin.stavkeposla.edit', $data)->with('posao_baza', $posao_baza);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StavkeposlovaUpdateRequest $request, $id)
    {
         $posao = StavkePosla::findOrFail($id);
        
        $posao->opis_radova = $request->input('opis_radova');
        
        $posao->save();
        
         /**
        * Izračunavamo cijenu posla  kod svake promjene u tablici stavkeposla
        * @param int $id  id evidencije
        */
         $this-> _calculate($posao->evidencijaposlova_id);
         
        return redirect("admin/stavkeposla/edit/$id")->withSuccess("Promjene su spremljene");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
         $posao = StavkePosla::findOrFail($id);
         $posao_baza = \App\Evidencijaposlova::find($posao->evidencijaposlova_id);
         $posao->delete();
         
         /**
        * Izračunavamo cijenu posla  kod svake promjene u tablici stavkeposla
        * @param int $id  id evidencije
        */
         $this-> _calculate($posao->evidencijaposlova_id);
        
        return redirect("admin/stavkeposla/show/$posao_baza->id")->withSuccess("Stavka '$posao->id' je obrisana.");
    }
    
    
    /**
     * Izračunavamo cijenu posla  kod svake promjene u tablici stavkeposla
     * @param int $id  d evidencije
     */
    private function _calculate($id)
    {
         $sve_stavke_evidencije = \App\Evidencijaposlova::find($id)->stavkePosla;
         $cijena_posla = 0;
         foreach($sve_stavke_evidencije as $sse){
             $cijena_posla +=  $sse->ukupna_cijena;
         }
        
          $evidencijaposlova = new \App\Evidencijaposlova();
          
         $evidencijaposlova::where('id', '=', $id)->update(array(
            'cijena_posla' => $cijena_posla
        ));

    }
}
