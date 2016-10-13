@extends('admin.layout')
@section('styles')
<link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
             <p><a href="{{ url('admin/stavkeposla/show', [$projekt->id]) }}" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Natrag</a></p>
            {{ $projekt->narucitelj }}, {{ $projekt->narucitelj_adresa }}, OIB {{ $projekt->narucitelj_oib }}, stavka posla: {{ $stavka_posla->broj_stavke}}</div>
        <div class="panel-body">
          <p>Opis radova: {{ $stavka_posla->opis_radova }}</p>
         
                
                <div class="col-md-4 col-md-offset-5">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add-matreijal"><i class="fa fa-plus"></i> Dodaj novi materijal</button>
                </div>
            
                 
        </div>  
    </div>
</div>
<div class="container-fluid">
 <div class="row">
        <div class="col-sm-11">

            @include('admin.partials.errors')
            @include('admin.partials.success')


            <table id="tags-table" class="table table-striped table-bordered">
                <thead>
                    <th class="hidden-sd">Naziv materijala</th>
                    <th class="hidden-sm">Mjerna jedinica</th>
                    <th class="hidden-sm">Cijena materijala</th>
                    <th class="hidden-sm">Potrošnja</th>
                    <th class="hidden-sm">Materijal</th>
                    <th class="hidden-sm">Kalkul sat</th>
                    <th class="hidden-sm">Norma sat</th>
                    <th class="hidden-sm">Rad</th>
                    <th class="hidden-sm">Cijena po jm.</th>
                    <th class="hidden-sm">Ucinak m2 sat</th>
                    <th class="hidden-md" data-sortable="false">Akcije</th>
                <tbody>
                @foreach($posaomaterijal as $pm)
                    <tr>
                        <td class="hidden-sd">{{ $pm->naziv_materijala }}</td>
                        <td class="hidden-sd">{{ $pm->mjerna_jedinica }}</td>
                        <td class="hidden-sd">{{ $pm->cijena_sa_popustom }}</td>
                        <td class="hidden-sm">{{ $pm->potrosnja_mat }}</td>
                        <td class="hidden-sm">{{ $pm->materijal }}</td>
                        <td class="hidden-sm">{{ $pm->kalkul_sat }}</td>
                        <td class="hidden-sm">{{ $pm->norma_sat }}</td>
                        <td class="hidden-sm">{{ $pm->rad }}</td>
                        <td class="hidden-sm">{{ $pm->cijena_po_jm }}</td>
                        <td class="hidden-sm">{{ $pm->ucinak_m2_sat }}</td>
                        <td class="hidden-md">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Radnje
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                    <!--<li><a href="/admin/posaomaterijal/edit/{{ $pm->pm_id }}" class=""><i class="fa fa-edit"></i> Uredi</a></li>-->
                                    <li>  <a href="/admin/posaomaterijal/destroy/{{$pm->id}}" class="" data-method="delete" data-token="{{csrf_token()}}"><i class="fa fa-trash"></i> Obriši Matreijal</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
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
</div>


<!--Add materijal-->
<div class="modal fade" id="modal-add-matreijal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Dodaj novi materijal</h4>
            </div>
            <div class="modal-body">
                <p class="lead">
                     {!! Form::open(['url' => '/admin/posaomaterijal/create',  'class' => 'form-horizontal']) !!}
       
                    <input type="hidden" name="id_stavke" value="{{ $stavka_posla->id }}">
                    
                    <div class="form-group">
                        <label for="materijal" class="col-md-3 control-label">Materijal</label>
                        <div class="col-md-8">
                        {!! Form::select('materijal_id', $listamaterijala,null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="page_image" class="col-md-3 control-label">Potrošnja</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="potrosnja_mat" id="potrosnja-mat" value="" autofocus>
                            <p class="form-control-static">Format upisa: 0.00</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="page_image" class="col-md-3 control-label">Kalku. sat</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="kalkul_sat" id="kalkul-sat" value="">
                            <p class="form-control-static">Format upisa: 0.00</p>
                        </div>
                    </div>
                
                <div class="form-group">
                        <label for="page_image" class="col-md-3 control-label">Norma po satu</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="norma_sat" id="norma_sat" value="">
                            <p class="form-control-static">Format upisa: 0.00</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="page_image" class="col-md-3 control-label">Minuta/sat</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="minuta" id="minuta" value="">
                            <p class="form-control-static">Format upisa: 0.00</p>
                        </div>
                    </div>
                    
                    
                    
          

          </p>  
        </div>
        <div class="modal-footer">

            <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-times-circle"></i> Dodaj</button>
          {!! Form::close() !!}
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