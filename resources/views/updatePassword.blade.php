@extends('layouts.app')

@section('title', 'Modifier mot de passe')
@section('content')
   <div class="container">
        <div class="text-header text-center ">
            <h2>Modifier mot de passe</h2>
        </div><br>
        <div class="col-md-6 col-xs-12 offset-md-3">
            <form action="{{route('savePassword')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label>Nouveau mot de passe :  </label>
                        <input type="password" name="pwd" class="form-control {{ $errors->has('pwd') ? 'is-invalid' :'' }}" value=""> 
                        @if ($errors->has('pwd'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pwd') }}</strong>
                            </span>
                        @endif
                    </div><br>
                    <div class="form-group">
                        <label>Confirmer le mot de passe :  </label>
                        <input type="password" name="cpwd" class="form-control {{ $errors->has('cpwd') ? 'is-invalid' :'' }}" value=""> 
                        @if ($errors->has('cpwd'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('cpwd') }}</strong>
                            </span>
                        @endif
                    </div><br>
                    <div class="form-group">
                        <input type="submit" value="Enregistrer" class="btn btn-success">
                    </div>
            </form>
        </div>
       
       
   </div>
@endsection