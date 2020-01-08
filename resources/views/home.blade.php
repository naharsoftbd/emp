@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="col-md-3"><a href="{{route('addemployee')}}" class="btn btn-success">Add Employe</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <form method="GET" action="{{ route('viewemployee') }}">
                        @csrf 
                    <h2>Find Employee</h2>
                    <select class="form-control" name="id">
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->emp_name}}</option>
                        @endforeach
                    </select>
                    <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary float-left">
                                    {{ __('View') }}
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
