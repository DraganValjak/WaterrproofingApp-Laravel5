<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterijalCreateRequest;
use App\Http\Requests\MaterijalUpdateRequest;
use App\Materijal;

class MaterijalController extends Controller
{
    
    protected $fields = [
        'naziv_materijala'  => '',
        'mjerna_jedinica'   => '',
        'cijena_materijala_po_jedinici'  => '',
        'rabat'  => '',
        'cijena_sa_popustom'  => '',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materijali = Materijal::all();
        
        return view('admin.materijal.index')->withMaterijali($materijali);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * Kad kliknemo na gumb za "Novi materijal", ili ako je došlo do greške kod unosa materijala,
         * forma ce se popuniti podacima koje smo  ranije unijeli ili praznim poljima ako unosimo novi materijal.
         */
       $data = [];
        foreach($this->fields  as $field => $default){
               $data[$field] = old($field, $default);
        }
        
        return view('admin.materijal.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterijalCreateRequest $request)
    {
        $materijal = new Materijal();
        /*
        foreach(array_keys($this->fields) as $field){
            $materijal->$field = $request->get($field);
        }
         * 
         */
        $materijal->naziv_materijala  = $request->input('naziv_materijala');
        $materijal->mjerna_jedinica   = $request->input('mjerna_jedinica');
        $materijal->cijena_materijala_po_jedinici  = $request->input('cijena_materijala_po_jedinici');
        $materijal->rabat  = $request->input('rabat');
         /*
         * Izracun cijene sa popustom primjer 13% od 75 = (13/100) X 75= 9,75(ukupni popust) 
         */
        $rabat_ukupno = ($materijal->rabat / 100) * $materijal->cijena_materijala_po_jedinici;
        $cijena_sa_popustom  = $materijal->cijena_materijala_po_jedinici - $rabat_ukupno;
        $materijal->cijena_sa_popustom  = $cijena_sa_popustom;
        
        $materijal->save();
        
        return redirect('admin/materijal')->withSuccess("Materijal '$materijal->naziv_materijala' je dodan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materijal = Materijal::findOrFail($id);
        $data = ['id' => $id]; // u array $data dodajemo $id 
        foreach(array_keys($this->fields)  as $field){
               $data[$field] = old($field, $materijal->$field);
        }
        
        return view('admin.materijal.edit', $data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterijalUpdateRequest $request, $id)
    {
        $materijal = Materijal::findOrFail($id);
        /**
        foreach(array_keys($this->fields) as $field){
            $materijal->$field = $request->get($field);
        }
         * 
         */
        $materijal->id = intval($id);
        $materijal->naziv_materijala  = $request->input('naziv_materijala');
        $materijal->mjerna_jedinica   = $request->input('mjerna_jedinica');
        $materijal->cijena_materijala_po_jedinici  = $request->input('cijena_materijala_po_jedinici');
        $materijal->rabat  = $request->input('rabat');
        /*
         * Izracun cijene sa popustom primjer 13% od 75 = (13/100) X 75= 9,75(ukupni popust) 
         */
        $rabat_ukupno = ($materijal->rabat / 100) * $materijal->cijena_materijala_po_jedinici;
        $cijena_sa_popustom  = $materijal->cijena_materijala_po_jedinici - $rabat_ukupno;
        $materijal->cijena_sa_popustom  = $cijena_sa_popustom;
        
        $materijal->save();
        
        
        return redirect("/admin/materijal/$id/edit")->withSuccess("Promjene su spremljene");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materijal = Materijal::findOrFail($id);
        $materijal->delete();
        
        return redirect('/admin/materijal')->withSuccess("Materijal '$materijal->naziv_materijala' je obrisan.");
    }
}
