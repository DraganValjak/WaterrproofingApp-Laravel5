@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-12">
                <h3>Poslovi <small>&raquo; Unos novog posla</small></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <p><a href="{{ URL::previous() }}" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Natrag</a></p>
                        <h3 class="panel-title">Nova forma za unos posla</h3>
                    </div>
                    <div class="panel-body">

                        @include('admin.partials.errors')

                        <form class="form-horizontal" role="form" method="POST" action="/admin/evidencijaposlova">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="mjesto_rada" class="col-md-3 control-label">Mjesto rada</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="mjesto_rada" id="mjesto-rada" value="{{ $mjesto_rada }}" autofocus>
                                </div>
                            </div>

                            @include('admin.evidencijaposlova._form')

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-7">
                                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i>&nbsp;Dodaj novi posao </button>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

