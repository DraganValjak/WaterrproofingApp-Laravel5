@extends('admin.layout')
@section('styles')
<link href="/assets/css/pdfexport.css" rel="stylesheet">
@stop
@section('content')

<div class="container">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
             <p><a href="{{ url('admin/stavkeposla/show',[$evidencija->id]) }}" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Natrag</a></p>
             <h4>Pregled stavke ponude</h4>
          </div>
        <div class="panel-body">

         
                
                <div class="col-md-4 col-md-offset-5">
               <button  class="btn btn-primary" id="create_pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Pretvori u PDF</button>
                </div>
            
                 
        </div>  
    </div>
</div>
</div>
<page size="A4">
<div id="target">
    
    <div class="row">
       
        <div class="col-xs-12">
 
    		<div class="row top-head">
                    <div class="col-xs-3 head-left">
    				 <img src="/assets/images/lukic-logo.png" alt="Waterrproofing co">
                                 <h2>Mob. 098 111 222</h2>
    			</div>
                    <div class="col-xs-6 head-center">
    				<address>
                                    <h1>WATERPROOFING CO</h1>
                                    <h2>Zagreb <span>Ilica BB</span></h2>
                                    <h2>OIB:72818256208</h2>
                                    <h2><span>Žiro račun:</span> IBAN HR78948499611050015727</h2>
                                </address>
    				
    			</div>
    			<div class="col-xs-3 head-right">
    				 <img src="/assets/images/lukic-logo.png" alt="Waterrproofing co">
                                  <h2>Tel fax 01 111 22 33</h2>
    			</div>
                    
    		</div><!--top-head-->
              <hr>
              
              <div class="row top-adddress">
                    <div class="col-xs-6 head-adddress-left">
                                 <p>Mjesto rada: {{ $evidencija->narucitelj_adresa }} </p>
    			</div>
                        
    			<div class="col-xs-6 head-adddress-right">
                            <address class="pull-right">
                                <p><strong>{{ $evidencija->mjesto_rada }}</strong></p>
                                <p><strong>{{ $evidencija->narucitelj_adresa }}</strong></p>
                                <p><strong>OIB: {{ $evidencija->narucitelj_oib }}</strong></p>
                            </address>
                                  
    			</div>
                    
    		</div><!--top-adddress-->
                
                 <div class="row invoice">
                    <div class="col-xs-12">
                        <h3>STAVKA PONUDE BR: 0{{ $evidencija->id }}.{{ $evidencija->created_at->format('my') }}-1</h3>
    			</div>
    		</div><!--invoice-->
                
                
                <div class="row stavke">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Stavka br: {{ $stavka->broj_stavke }}</strong></h3>
                                <p><strong>Opis radova:</strong> {{ $stavka->opis_radova }}</p>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed stavkamaterijal">
                                        <thead>
                                            <tr>
                                                <th>Naziv materijala</th>
                                                <th>Mjerna jedinica</th>
                                                <th>Cijena materijala</th>
                                                <th>Potrošnja</th>
                                                <th>Materijal</th>
                                                <th>Kalkul sat</th>
                                                <th>Norma sat</th>
                                                <th>Rad</th>
                                                <th>Cijena po jm.</th>
                                                <th>Ucinak m2 sat</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($stavkeposlovi as $pm)
                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                            <tr>
                                                <td>{{ $pm->naziv_materijala }}</td>
                                                <td>{{ $pm->mjerna_jedinica }}</td>
                                                <td>{{ $pm->cijena_sa_popustom }}</td>
                                                <td>{{ $pm->potrosnja_mat }}</td>
                                                <td>{{ $pm->materijal }}</td>
                                                <td>{{ $pm->kalkul_sat }}</td>
                                                <td>{{ $pm->norma_sat }}</td>
                                                <td>{{ $pm->rad }}</td>
                                                <td>{{ $pm->cijena_po_jm }}</td>
                                                <td>{{ $pm->ucinak_m2_sat }}</td>
                                            </tr>
                                            @endforeach

                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-left"><strong>Cijena posla:</strong></td>
                                                <td class="no-line text-right">{{ $stavka->cijena_posla }} - kn</td>
                                            </tr>
                                              <tr>
                                               <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-left"><strong>Ukupna cijena:</strong></td>
                                                <td class="no-line text-right">{{ $stavka->ukupna_cijena }} - kn</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-7">
                                    <p>Obračun prema stvarnim količinama.</p>     
                                    <p>{{ date('d.m.Y') }}</p>  
                                </div>
                                <div class="col-xs-4">
                                    <div class="pull-right">
                                        <p class="line"><strong>Direktor</strong></p>

                                        <p class="no-line"><strong>Ivica Ivić</strong></p>
                                    </div>
                                </div>
                                <div class="col-xs-1"></div>
                            </div>
                        </div>
                        
                        
                   
                    </div>
                    
                    
                    
                    
                </div><!--/.stavke-->
                
                
                
                
                <div class="row end">
                   
    		</div><!--end-->



              
    	</div><!--col-xs-12-->
       
    </div><!--row-->
   
     
     
 
    
</div>
    </page>
@stop

@section('scripts')
    <script src="/assets/js/jspdf.min.js"></script>
    <script src="http://mrrio.github.io/jsPDF/dist/jspdf.debug.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/niklasvh/html2canvas/0.5.0-alpha2/dist/html2canvas.min.js"></script>

    <script type="text/javascript">
 (function(){
    var target = $('#target'),
    cache_width = target.width(),
    a4  =[ 595.28,  841.89];  // for a4 size paper width and height
     
    $('#create_pdf').on('click',function(){
     $('#target').scrollTop(0);
     createPDF();
    });
    //create pdf
    function createPDF(){
     getCanvas().then(function(canvas){
      var 
      img = canvas.toDataURL("image/png"),
      doc = new jsPDF({
              unit:'px', 
              format:'a4'
            });     
            doc.addImage(img, 'JPEG', 20, 20);
            doc.save('ponuda.pdf');
            target.width(cache_width);
     });
    }
     
    // create canvas object
    function getCanvas(){
     target.width((a4[0]*1.33333) -60).css('max-width','none');
     return html2canvas(target,{
         imageTimeout:2000,
         removeContainer:true
        }); 
    }
     
    }());
    </script>
@stop