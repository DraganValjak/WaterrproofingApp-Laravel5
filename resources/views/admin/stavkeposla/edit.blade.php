@extends('admin.layout')

@section('content')
 <div class="container-fluid">
       
 

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p><a href="{{ url('/admin/stavkeposla/show', [$posao_baza->id]) }}" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Natrag</a></p>
                        <h4>Stavka posla za  <small>&raquo; {{ $posao_baza->narucitelj }}</small>. Broj stavke {{ $broj_stavke }} </h4>
                        
                        
                    </div>
                    <div class="panel-body">

                        @include('admin.partials.errors')
                        @include('admin.partials.success')

                        <form class="form-horizontal" role="form" method="POST" action="/admin/stavkeposla/update/{{ $id }}">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $id }}">

                            @include('admin.stavkeposla._form')

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-7">
                                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i>&nbsp; Spremi promjene </button>
                                    <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-plus-circle"></i>&nbsp; Obriši </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm delete-->
    <div class="modal fade" id="modal-delete" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Molim potvrdite</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i> Jeste li sigurni da želite obrisati stavku ?
                        <br>
                        Brisanjem ćete izbrisati sve materijale ove stavke.
                    </p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="/admin/stavkeposla/destroy/{{ $id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle"></i> Obriši</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    
     </div>
     
     
 
@stop
