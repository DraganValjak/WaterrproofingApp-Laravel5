@extends('admin.layout')
@section('styles')
<link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
    
                <h3>Stavke posla za  <small>&raquo; {{$posao_baza->narucitelj }}</small></h3>
            </div>
            <div class="col-md-6">
                 <p><a href="{{ url('admin/projekt') }}" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Natrag</a></p>
              
            </div>
           
        </div>


    <div class="row">
        <div class="col-sm-12">

            @include('admin.partials.errors')
            @include('admin.partials.success')


            <table id="tags-table" class="table table-striped table-bordered">
                <thead>
                    <th class="hidden-sm">Broj stavke</th>
                    <th class="hidden-md">Opis radova</th>
                    <th class="hidden-md">Cijena posla</th>
                    <th class="hidden-sm">Ukupna cijena</th>
                    <th class="hidden-md">Datum izrade</th>
                    <th data-sortable="false">Akcije</th>
                <tbody>
                @foreach($posao as $p)
                    <tr>
                        <td class="hidden-sm">{{ $p->broj_stavke }}</td>
                        <td class="hidden-md">{{ $p->opis_radova }}</td>
                        <td class="hidden-md">{{ $p->cijena_posla }}</td>
                        <td class="hidden-md">{{ $p->ukupna_cijena }}</td>
                        <td class="hidden-md">{{ $p->created_at->formatLocalized('%d.%m.%Y') }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Radnje
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                    <li>  <a href="/admin/projekt/materijali/{{ $p->id }}" class=""><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Materijali</a></li>
                                    <li><a href="#">PDF ispisi</a></li>
                                    <li><a href="/admin/pdfracun/stavkematerijali/{{ $posao_baza->id }}/{{$p->id}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Stavka/materijali</a></li>
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



  <!--Add-->
    <div class="modal fade" id="modal-add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Dodaj novu stavku</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                          <form class="form-horizontal" role="form" method="POST" action="/admin/stavkeposla/store/{{ $posao_baza->id }}">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <div class="form-group">
    <label for="opis_radova" class="col-md-3 control-label">opis radova</label>
    <div class="col-md-8">
        <textarea class="form-control" id="opis-radova" name="opis_radova" rows="3"></textarea>
    </div>
</div>

                    </p>
                </div>
                <div class="modal-footer">
              
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-times-circle"></i> Dodaj</button>
                    </form>
                </div>
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