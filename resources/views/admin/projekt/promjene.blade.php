@extends('admin.layout')
@section('styles')
<link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
             <p><a href="{{ url('admin/projekt/stavke', [$projekt->id]) }}" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Natrag</a></p>
            {{ $projekt->narucitelj }}, {{ $projekt->narucitelj_adresa }}, OIB {{ $projekt->narucitelj_oib }}, stavka posla: {{ $stavka_posla->broj_stavke}}</div>
        <div class="panel-body">
          <p>Opis radova: {{ $stavka_posla->opis_radova }}</p>
          <h4>Ugovorena potrošnja</h4>
              <table  class="table table-bordered">
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
                 
              
                    <tr>
                        <td class="hidden-sd">{{ $posaomaterijal->naziv_materijala }}</td>
                        <td class="hidden-sd">{{ $posaomaterijal->mjerna_jedinica }}</td>
                        <td class="hidden-sd">{{ $posaomaterijal->cijena_sa_popustom }}</td>
                        <td class="hidden-sm">{{ $posaomaterijal->potrosnja_mat }}</td>
                        <td class="hidden-sm">{{ $posaomaterijal->materijal }}</td>
                        <td class="hidden-sm">{{ $posaomaterijal->kalkul_sat }}</td>
                        <td class="hidden-sm">{{ $posaomaterijal->norma_sat }}</td>
                        <td class="hidden-sm">{{ $posaomaterijal->rad }}</td>
                        <td class="hidden-sm">{{ $posaomaterijal->cijena_po_jm }}</td>
                        <td class="hidden-sm">{{ $posaomaterijal->ucinak_m2_sat }}</td>
                        <td class="hidden-md">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Radnje
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                    <li><a href="/admin/projekt/promjene/{{ $posaomaterijal->id }}" class=""><i class="fa fa-edit"></i> Promjene</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                 
                </tbody>
            </table>    
              
                 
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
                    <th class="hidden-sm">Datum</th>
                    <th class="hidden-sm">Potrošnja</th>
                    <th class="hidden-md" data-sortable="false">Akcije</th>
                <tbody>
             
                    
                        
                @foreach($posaomatmjesec as $pm)
                    <tr>
                        <td class="hidden-sd">{{ $pm->created_at }}</td>
                        <td class="hidden-sm">{{ $pm->potrosnja_mat }}</td>
                        <td class="hidden-md">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Radnje
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                    <li><a href="/admin/projekt/promjene/{{ $pm->id }}" class=""><i class="fa fa-edit"></i> Promjene</a></li>
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