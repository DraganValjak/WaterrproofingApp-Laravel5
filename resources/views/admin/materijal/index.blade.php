@extends('admin.layout')
@section('styles')
<link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>Materijali <small>&raquo; lista</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/materijal/create" class="btn btn-success btn-md"><i class="fa fa-plus-circle"></i> Novi materijal</a>
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
                    <th>Naziv materijala</th>
                    <th>Mjerna jedinica</th>
                    <th>Cijena po jedinici</th>
                    <th>Rabat</th>
                    <th>Cijena sa popustom</th>
                    <th data-sortable="false">Akcije</th>
                    </tr>
                <tbody>
                @foreach($materijali as $m)
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td>{{ $m->naziv_materijala }}</td>
                        <td>{{ $m->mjerna_jedinica }}</td>
                        <td>{{ $m->cijena_materijala_po_jedinici }}</td>
                        <td>{{ $m->rabat }}</td>
                        <td>{{ $m->cijena_sa_popustom }}</td>
                        <td>
                            <a href="/admin/materijal/{{ $m->id }}/edit" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Uredi</a>
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