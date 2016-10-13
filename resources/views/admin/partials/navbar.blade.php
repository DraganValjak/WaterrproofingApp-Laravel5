<ul class="nav navbar-nav">
    @if(Auth::check())
        <li @if(Request::is('admin/evidencijaposlova*')) class="active" @endif>
            <a href="/admin/evidencijaposlova">Evidencija ponuda</a>
        </li>
        <li @if(Request::is('admin/materijali*')) class="active" @endif>
            <a href="/admin/materijal">Materijali</a>
        </li>
         <li @if(Request::is('admin/projekt*')) class="active" @endif>
            <a href="/admin/projekt">Projekti</a>
        </li>
    @endif
</ul>

<ul class="nav navbar-nav navbar-right">
    @if(Auth::guest())
        <li><a href="#">Dobrodošli gost</a></li>
        @else
           <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="/auth/logout">Odjava</a></li>
                  </ul>
           </li>
    @endif
</ul>