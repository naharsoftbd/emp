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
            
               
                
                    <h2>Punishment Details</h2>
                    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Date</th>
        <th>Offence</th>
        <th>Punishment</th>
        <th>Punishment Line 1</th>
        <th>Punishment Line 2</th>
        <th>Remarks</th>
      </tr>
    </thead>
    <tbody>
        
      <tr>
        <td>{{$disaction->godate}}</td>
        <td>{{$disaction->offence}}</td>
        <td>{{$disaction->nopunishment}}</td>
        <td>{{$disaction->punishment1}}</td>
        <td>{{$disaction->punishment2}}</td>
        <td>{{$disaction->remarks}}</td>
      </tr>
      
      
    </tbody>
  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
