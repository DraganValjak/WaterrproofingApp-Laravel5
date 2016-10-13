@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-12">
                <h3>Tags <small>&raquo; Unos novog materijala</small></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <p><a href="{{ URL::previous() }}" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Natrag</a></p>
                        <h3 class="panel-title">Nova forma za unos materijala</h3>
                    </div>
                    <div class="panel-body">

                        @include('admin.partials.errors')

                        <form class="form-horizontal" role="form" method="POST" action="/admin/materijal">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">Materijal</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="naziv_materijala" id="naziv-materijala" value="{{ $naziv_materijala }}" autofocus>
                                </div>
                            </div>

                            @include('admin.materijal._form')

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-7">
                                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i>&nbsp;Dodaj novi materijal </button>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/assets/js/decimal.js"></script>
    <script>
       $( document ).ready(function() {
             $(".numeric").numeric({ decimal : ".",  negative : false, scale: 2 });
        });
    </script>
@stop