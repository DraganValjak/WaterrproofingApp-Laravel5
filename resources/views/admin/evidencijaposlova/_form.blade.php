<div class="form-group">
    <label for="narucitelj" class="col-md-3 control-label">Narucitelj</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="narucitelj" id="narucitelj" value="{{ $narucitelj }}">
    </div>
</div>

<div class="form-group">
    <label for="narucitelj_adresa" class="col-md-3 control-label">Naručitelj adresa</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="narucitelj_adresa" id="narucitelj" value="{{ $narucitelj_adresa }}">
    </div>
</div>


<div class="form-group">
    <label for="narucitelj_oib" class="col-md-3 control-label">Naručitelj OIB</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="narucitelj_oib" id="rabat" value="{{ $narucitelj_oib }}">
    </div>
</div>


<div class="form-group">
    <label for="cijena_posla" class="col-md-3 control-label">Cijena posla</label>
    <div class="col-md-4">
       <input type="hidden" class="form-control" name="cijena_posla" id="cijena-posla" value="{{ $cijena_posla }}"> 
      <p class="form-control-static">{{ $cijena_posla }}</p>
    </div>
</div>

 <input type="hidden" class="form-control" name="izdata_ponuda" id="izdata_ponuda" value="{{ $izdata_ponuda }}"> 

