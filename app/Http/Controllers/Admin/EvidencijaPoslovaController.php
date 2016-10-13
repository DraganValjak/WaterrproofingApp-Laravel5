<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvidencijaposlovaCreateRequest;
use App\Http\Requests\EvidencijaposlovaUpdateRequest;
use App\Evidencijaposlova;

class EvidencijaPoslovaController extends Controller
{
    
      protected $fields = [
        'mjesto_rada'  => '',
        'narucitelj'   => '',
        'narucitelj_adresa'  => '',
        'narucitelj_oib'  => '',
        'cijena_posla'  => '0',
        'izdata_ponuda'  => '0',  
    ];
      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * Kod svakog dolask ana index stranicu radimo ponovni obracun cijena iz stavki 
         */
        $r = 0;
        $evidencija = Evidencijaposlova::where('izdata_ponuda' , '=', '0')->get();
        if(count($evidencija)){
            foreach($evidencija as $ev){
             $stavke = Evidencijaposlova::find($ev->id)->stavkePosla;
             foreach ($stavke as $s){
               $r +=  $s->ukupna_cijena;
             }
             Evidencijaposlova::where('id', '=', $ev->id)->update(array(
            'cijena_posla' => $r
               ));
             $r = 0;
            }   
        }
        // izvlacimo sve ponude 
          $evidencijaposlova = Evidencijaposlova::where('izdata_ponuda' , '=', '0')->get();
      
        return view('admin.evidencijaposlova.index')->withEvidencijaposlova($evidencijaposlova);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * Kad kliknemo na gumb za "Novi posao", ili ako je došlo do greške kod unosa materijala,
         * forma ce se popuniti podacima koje smo  ranije unijeli ili praznim poljima ako unosimo novi posao.
         */
       $data = [];
        foreach($this->fields  as $field => $default){
         $data[$field] = old($field, $default);
        }
        
        return view('admin.evidencijaposlova.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EvidencijaposlovaCreateRequest $request)
    {
        $evidencija = new Evidencijaposlova();
        foreach(array_keys($this->fields) as $field){
            $evidencija->$field = $request->get($field);
        }
        
        $evidencija->save();
        
        return redirect('admin/evidencijaposlova')->withSuccess("Posao  za '$evidencija->narucitelj' je dodan.");
    }

    /**
     *Pomocu ove funkcije prebacujemo ponudu u projekt
     *link: /admin/evidencijaposlova/{{$e->id}}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evidencija = Evidencijaposlova::findOrFail($id);
         Evidencijaposlova::where('id', '=', $id)->update(array(
            'izdata_ponuda' => 1
               ));  
          	
                 return redirect()->back()->withSuccess("Promjene su spremljene");   
     
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evidencija = Evidencijaposlova::findOrFail($id);
        $data = ['id' => $id]; // u array $data dodajemo $id 
        foreach(array_keys($this->fields)  as $field){
               $data[$field] = old($field, $evidencija->$field);
        }
        
        return view('admin.evidencijaposlova.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EvidencijaposlovaUpdateRequest $request, $id)
    {
        $evidencija = Evidencijaposlova::findOrFail($id);
        
        foreach(array_keys($this->fields) as $field){
            $evidencija->$field = $request->get($field);
        }
        
        $evidencija->save();
        
        
        return redirect("/admin/evidencijaposlova/$id/edit")->withSuccess("Promjene su spremljene");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evidencija = Evidencijaposlova::findOrFail($id);
        $evidencija->delete();
        
        return redirect('/admin/evidencijaposlova')->withSuccess("Posao '$evidencija->narucitelj' je obrisan.");
    }
    
   
    
}
