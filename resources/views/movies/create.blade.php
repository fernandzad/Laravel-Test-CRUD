@extends('movies.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Movie</h2>
        </div>
        <div class="pull-right">
            <br/>        
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('movies.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Duration:</strong>
                <input type="text" name="duration" class="form-control" placeholder="Duration mins."></input>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Creator(s):</strong>
                <input type="text" name="creators" class="form-control" placeholder="Creator(s) comma separated"></input>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Rate:</strong>
                <input type="number" step=".01" name="rate" class="form-control" placeholder="Rate (1.00 to 10.00 scale)">
            </div>
        </div>
        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Synopsis</strong>
                <textarea class="form-control" style="height:150px" name="synopsis" id="synopsis" placeholder="Synopsis"></textarea>
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Géneros: </strong>
                    <select class="form-control" multiple data-live-search="true" style="height:150px" name="genres[]">
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('movies.index') }}">Back</a>
        </div>
        
    </div>
   
</form>
@endsection