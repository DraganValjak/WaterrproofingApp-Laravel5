<div class="form-group">
    <label for="title" class="col-md-3 control-label">Mjerna jedinica</label>
    <div class="col-md-3">
        <p class="form-control-static">{{ $materijal_donos->mjerna_jedinica }}</p>
    </div>
</div>

<div class="form-group">
    <label for="subtitle" class="col-md-3 control-label">Cijena materijala po jedinici (kn)</label>
    <div class="col-md-3">
       <p class="form-control-static">{{ $materijal_donos->cijena_materijala_po_jedinici }}</p>
    </div>
</div>


<div class="form-group">
    <label for="meta_description" class="col-md-3 control-label">Rabat (%)</label>
    <div class="col-md-3">
        <p class="form-control-static">{{ $materijal_donos->rabat }}</p>
    </div>
</div>


<div class="form-group">
    <label for="page_image" class="col-md-3 control-label">Cijena sa popustom (Kn)</label>
    <div class="col-md-3">
       <p class="form-control-static">{{ $materijal_donos->cijena_sa_popustom }}</p>
    </div>
</div>

<div class="form-group">
    <label for="page_image" class="col-md-3 control-label">Potrošnja</label>
    <div class="col-md-3">
         <input type="text" class="form-control" name="potrosnja_mat" id="potrosnja-mat" value="{{ $potrosnja_mat }}" autofocus>
       <p class="form-control-static">Format upisa: 0.00</p>
    </div>
</div>


<div class="form-group">
    <label for="page_image" class="col-md-3 control-label">Kalku. sat</label>
    <div class="col-md-3">
         <input type="text" class="form-control" name="kalkul_sat" id="kalkul-sat" value="{{ $kalkul_sat }}">
       <p class="form-control-static">Format upisa: 0.00</p>
    </div>
</div>


<div class="form-group">
    <label for="page_image" class="col-md-3 control-label">Minuta/sat</label>
    <div class="col-md-3">
         <input type="text" class="form-control" name="minuta" id="minuta" value="{{ $minuta }}">
       <p class="form-control-static">Format upisa: 0.00</p>
    </div>
</div>



