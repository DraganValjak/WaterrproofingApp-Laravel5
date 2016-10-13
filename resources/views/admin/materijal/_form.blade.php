<div class="form-group">
    <label for="title" class="col-md-3 control-label">Mjerna jedinica</label>
    <div class="col-md-3">
        <input type="text" class="form-control" name="mjerna_jedinica" id="mjerna-jedinica" value="{{ $mjerna_jedinica }}">
    </div>
</div>

<div class="form-group">
    <label for="subtitle" class="col-md-3 control-label">Cijena materijala po jedinici (kn)</label>
    <div class="col-md-3">
        <input type="text" class="form-control numeric" name="cijena_materijala_po_jedinici" id="scijena_materijala_po_jedinici" value="{{ $cijena_materijala_po_jedinici }}">
        <p class="help-block">Format unosa: 00.00</p>
    </div>
</div>


<div class="form-group">
    <label for="meta_description" class="col-md-3 control-label">Rabat (%)</label>
    <div class="col-md-3">
        <input type="text" class="form-control numeric" name="rabat" id="rabat" value="{{ $rabat }}">
        <p class="help-block">Format unosa: 00.00</p>
    </div>
</div>





