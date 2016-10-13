@extends('admin.layout')

@section('content')

    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-12">
                <h3>{{  $evidencijaposlova->narucitelj }} <small>&raquo; Broj stavke {{ $stavka_posla->broj_stavke }}</small></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p><a href="{{ URL::previous() }}" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Natrag</a></p>
                        <h3 class="panel-title">Forma za dodavanje materijala</h3>
                    </div>
                    <div class="panel-body">

                        @include('admin.partials.errors')
                        @include('admin.partials.success')

                        <form class="form-horizontal" role="form" method="POST" action="/admin/posaomaterijal/store/{{ $materijal_donos->id }}">
                         
                       
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                             
                            <input type="hidden" name="materijal_id" value="{{ $materijal_donos->id }}">
                             <input type="hidden" name="stavke_posla_id" value="{{ $stavka_posla->id }}">


                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">Materijal</label>
                                <div class="col-md-8">
                                   <p class="form-control-static">{{ $materijal_donos->naziv_materijala }}</p>
                                </div>
                            </div>

                            @include('admin.posaomaterijal._form')

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-7">
                                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i>&nbsp; Dodaj </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@stop