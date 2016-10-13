@extends('admin.layout')
@section('styles')
<link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>Projekti <small>&raquo; lista</small></h3>
            </div>
        </div>


    <div class="row">
        <div class="col-sm-12">

            @include('admin.partials.errors')
            @include('admin.partials.success')


            <table id="tags-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Red. broj</th>
                    <th>Naručitelj</th>
                    <th>Cijena posla</th>
                    <th>Datum izrade</th>
                    <th>Akcije</th>
                    </tr>
                <tbody>
                @foreach($evidencijaposlova as $e)
                    <tr>
                        <td>{{ $e->id }}</td>
                        <td><p>{{ $e->narucitelj }}</p><p>{{ $e->narucitelj_adresa }}</p></td>
                        <td>{{ $e->cijena_posla }}</td>
                        <td>{{ $e->created_at->formatLocalized('%d.%m.%Y') }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Radnje
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                    <li><a href="/admin/projekt/stavke/{{ $e->id }}" class=""><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Stavke</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">PDF ispisi</a></li>
                                    <li><a href="/admin/pdfracun/{{ $e->id }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Račun</a></li>
                                    <li><a href="/admin/pdfracun/stavke/{{ $e->id }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Stavke</a></li>
                                    <li><a href="/admin/pdfracun/rekapitaulacija/{{ $e->id }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Rekapitaulacija</a></li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
             </div>
         </div>
    </div>

 
@stop

@section('scripts')
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script>
        $(function(){
            $("#tags-table").DataTable( {
       
         "language": {
                "url": "/assets/js/i18n/Croatian.json"
            }
        });  
       
        });
    </script>
@stop