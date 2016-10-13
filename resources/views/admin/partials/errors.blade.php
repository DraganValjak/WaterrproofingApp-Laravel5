@if(count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Ooopsss</strong>
        Došlo je do greške kod unosa.<br><br>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
        </ul>
    </div>
@endif