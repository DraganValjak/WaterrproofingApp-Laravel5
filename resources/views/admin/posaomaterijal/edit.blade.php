@extends('admin.layout')

@section('content')
 <div class="container-fluid">
       
 

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       
                        <h4>Materijal za  <small>&raquo; {{ $posao_baza->narucitelj }}</small>. Broj stavke {{ $stavka->broj_stavke }} </h4>
                        
                        
                    </div>
                    <div class="panel-body">

                        @include('admin.partials.errors')
                        @include('admin.partials.success')

                        <form class="form-horizontal" role="form" method="POST" action="admin/posaomaterijal/update/{{ $pm_id }}" accept-charset="UTF-8">
                               <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                        

                    
                   
                    
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
                            <input type="text" class="form-control" name="kalkul_sat" id="kalkul-sat" value="{{ $kalkul_sat  }}">
                            <p class="form-control-static">Format upisa: 0.00</p>
                        </div>
                    </div>
                
                <div class="form-group">
                        <label for="page_image" class="col-md-3 control-label">Norma po satu</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="norma_sat" id="norma_sat" value="{{ $norma_sat }}">
                            <p class="form-control-static">Format upisa: 0.00</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="page_image" class="col-md-3 control-label">Minuta/sat</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="minuta" id="minuta" value="{{$minuta}}">
                            <p class="form-control-static">Format upisa: 0.00</p>
                        </div>
                    </div>
                    
                    

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-7">
                                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i>&nbsp; Spremi promjene </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@stop
