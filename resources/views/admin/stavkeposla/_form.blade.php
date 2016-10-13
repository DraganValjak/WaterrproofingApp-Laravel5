<div class="form-group">
    <label for="opis_radova" class="col-md-3 control-label">opis radova</label>
    <div class="col-md-8">
        <textarea class="form-control" id="opis-radova" name="opis_radova" rows="3">{{ $opis_radova }}</textarea>
    </div>
</div>


<div class="form-group">
    <label for="cijena_posla" class="col-md-3 control-label">Cijena posla</label>
    <div class="col-md-4">
       <input type="hidden" class="form-control" name="cijena_posla" id="cijena-posla" value="{{ $cijena_posla }}"> 
      <p class="form-control-static">{{ $cijena_posla }}</p>
    </div>
</div>

<div class="form-group">
    <label for="ukupna_cijena" class="col-md-3 control-label">Ukupna cijena</label>
    <div class="col-md-4">
       <input type="hidden" class="form-control" name="ukupna_cijena" id="ukupna-cijena" value="{{ $ukupna_cijena }}"> 
      <p class="form-control-static">{{ $ukupna_cijena }}</p>
    </div>
</div>



