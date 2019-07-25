@extends('movies.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Welcome to the new IMDb - Watch all the information about your favourites movies</h2>
            </div>
            
        </div>
    </div>
   
    @if ($message = Session::get('message'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Duration</th>
            
            <th width="50px">Rate</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($movies as $movie)
        <tr>
            <td>{{ $movie->id }}</td>
            <td>{{ $movie->name }}</td>
            <td>{{ $movie->duration }} min.</td>
            
            
            <td>{{ $movie->rate }} </td>
            <td>
                <form action="{{ route('movies.destroy',$movie->id) }}" method="POST">

                    <a class="badge badge-primary" href="{{ route('movies.show',$movie->id) }}">Show</a>
    
                    <a class="badge badge-warning" href="{{ route('movies.edit',$movie->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" onclick="return confirm('¿Está seguro que desea eliminar el producto?')" class="badge badge-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $movies->links() !!}
      
@endsection