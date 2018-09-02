@extends('layouts.app')

@section('title', 'Modifier les informations')
@section('content')
   <div class="container">
        <div class="text-header text-center ">
            <h2>Modifier les informations</h2>
        </div><br>
        <div class="col-md-6 col-xs-12 offset-md-3">
            @if(Session::has('status'))
            <div class="alert alert-success" id="successUpdate">
            <span>{{ Session::get('status')}} </span>
            </div>
            @endif
            <form action="{{route('saveUpdate')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label>Nom & prenom  </label>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', Auth::user()->name)  }}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Adresse email  </label>
                        <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' :'' }}" value="{{ old('email', Auth::user()->email)  }}">
                        
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
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