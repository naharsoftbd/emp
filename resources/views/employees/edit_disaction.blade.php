@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                <br>
                <form method="POST" action="{{ route('updatedisaction',['id' => $disaction->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Go Date') }}</label>

                            <div class="col-md-6">
                                <input id="godate" type="date" class="form-control @error('name') is-invalid @enderror" name="godate" value="{{ $disaction->godate}}" required autocomplete="godate" autofocus>

                                @error('godate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="offence" class="col-md-4 col-form-label text-md-right">{{ __('Offence') }}</label>

                            <div class="col-md-6">
                                <input id="offence" type="text" class="form-control @error('offence') is-invalid @enderror" name="offence" required autocomplete="new-offence" value="{{ $disaction->offence}}">

                                @error('offence')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nopunishment" class="col-md-4 col-form-label text-md-right">{{ __('Nature of Punishment') }}</label>

                            <div class="col-md-6">
                                <input id="nopunishment" type="text" class="form-control @error('nopunishment') is-invalid @enderror" name="nopunishment" value="{{ $disaction->nopunishment}}" required autocomplete="location">

                                @error('nopunishment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nopunishment1" class="col-md-4 col-form-label text-md-right">{{ __('Punishment Line1') }}</label>

                            <div class="col-md-6">
                                <input id="nopunishment1" type="text" class="form-control @error('nopunishment1') is-invalid @enderror" name="nopunishment1" value="{{ $disaction->punishment1 }}" required autocomplete="nopunishment1">

                                @error('nopunishment1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nopunishment2" class="col-md-4 col-form-label text-md-right">{{ __('Punishment Line2') }}</label>

                            <div class="col-md-6">
                                <input id="nopunishment2" type="text" class="form-control @error('nopunishment2') is-invalid @enderror" name="nopunishment2" value="{{ $disaction->punishment2 }}" required autocomplete="nopunishment2">

                                @error('nopunishment2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="remarks" class="col-md-4 col-form-label text-md-right">{{ __('Remarks') }}</label>

                            <div class="col-md-6">
                                <input id="remarks" type="text" class="form-control @error('remarks') is-invalid @enderror" name="remarks" value="{{ $disaction->remarks }}" required autocomplete="remarks">

                                @error('remarks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>             
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
