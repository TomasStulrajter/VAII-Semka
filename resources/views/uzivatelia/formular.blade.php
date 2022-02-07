<form method="post" action="{{ $ukon }}">
    @csrf
    @method($metoda)
    <div class="form-group row">
        <label for="meno" class="col-sm-2 col-md-3 col-form-label">Meno</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="meno" name="name" placeholder="napr. Janko Hraško", value="{{ @$model[0]->name }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="mail" class="col-sm-2 col-md-3 col-form-label">E-mail</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="mail" name="email" placeholder="adresa@priklad.com", value="{{ @$model[0]->email }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="heslo" class="col-sm-2 col-md-3 col-form-label">Heslo</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="heslo" name="password" placeholder="napr. 1234 :)">
        </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-primary form-control" style="margin-top: 15px">Ulož</button>
    </div>
    <br>
    <div id='chybove_hlasky'>
        @foreach($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
    </div>
</form>
