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
                    <div class="row">
                   <div class="col-md-6">

                    <table class="table-bordered">
                        <tbody>
                            <thead>
                                <th>Employee Code</th>
                                <th><a href="{{route('editemployee',['id'=>$employee->id])}}">Edit Employee</a></th>
                            </thead>
                            
                            
                            <tr><th>Name</th><td>{{$employee->emp_name}}</td></tr>
                            <tr><th>Designation</th><td>{{$employee->emp_designation}}</td></tr>
                            <tr><th>Location</th><td>{{$employee->location}}</td></tr>
                        
                            <tr><th>Rank</th><td>{{$employee->rank}}</td></tr>
                            <tr><th>Organization</th><td>{{$employee->organization}}</td></tr>
                            <tr><th>SPDS</th><td>{{$employee->spds}}</td></tr>
                        
                        
                    
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <img src="{{URL::to('/')}}/{{$employee->profile_photo}}" width="300">
                </div>
                </div>
                <br>
                <form method="POST" action="{{ route('adddisaction',['id' => $employee->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Go Date') }}</label>

                            <div class="col-md-6">
                                <input id="godate" type="date" class="form-control @error('name') is-invalid @enderror" name="godate" value="{{ old('name') }}" required autocomplete="godate" autofocus>

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
                                <input id="offence" type="text" class="form-control @error('offence') is-invalid @enderror" name="offence" required autocomplete="new-offence">

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
                                <input id="nopunishment" type="text" class="form-control @error('nopunishment') is-invalid @enderror" name="nopunishment" value="{{ old('nopunishment') }}" required autocomplete="location">

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
                                <input id="nopunishment1" type="text" class="form-control @error('nopunishment1') is-invalid @enderror" name="nopunishment1" value="{{ old('nopunishment1') }}" required autocomplete="nopunishment1">

                                @error('nopunishment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nopunishment2" class="col-md-4 col-form-label text-md-right">{{ __('Punishment Line2') }}</label>

                            <div class="col-md-6">
                                <input id="nopunishment2" type="text" class="form-control @error('nopunishment2') is-invalid @enderror" name="nopunishment2" value="{{ old('nopunishment2') }}" required autocomplete="nopunishment2">

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
                                <input id="remarks" type="text" class="form-control @error('remarks') is-invalid @enderror" name="remarks" value="{{ old('remarks') }}" required autocomplete="remarks">

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
                    <h2>List of Punishment</h2>
                    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Date</th>
        <th>Offence</th>
        <th>Punishment</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($disactions as $disaction)
      <tr>
        <td>{{$disaction->godate}}</td>
        <td>{{$disaction->offence}}</td>
        <td>{{$disaction->nopunishment}}</td>
        <td><a href="{{route('viewdisaction',['id'=>$disaction->id])}}">View</a>||<a href="{{route('editdisaction',['id'=>$disaction->id])}}">Edit</a>||<a href="{{route('deletedisaction',['id'=>$disaction->id])}}">Delete</a></td>
      </tr>
      @endforeach;
      <tr><td>{{ $disactions->appends(['id' => $employee->id])->links() }}</td></tr>
      
    </tbody>
  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
