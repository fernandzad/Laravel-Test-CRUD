<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $movies = Movie::first()->paginate(5);
        return view('movies.index')->with('movies', $movies);
        //return view('movies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = \App\Genre::all();
        return view('movies.create')->with('genres', $genres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'duration' => 'required',
            'creators' => 'required',
            'rate' => 'required',
            'synopsis' => 'required'
        ]);

        $idMovie = Movie::create($request->except('genres'))->id;

        $genres = $request->input('genres');
        foreach ($genres as $genre) {
            \App\MovieGenre::create(['idMovie' => $idMovie,
                                'idGenre' => $genre,
                                ]);
        }

        return redirect()->route('movies.index')->with('message', 'The movie was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        $idMovie = $movie->id;
        $genres = DB::table('genres')
                    ->join('movies_genres', 'movies_genres.idGenre', '=', 'genres.id')
                    ->join('movies', 'movies.id', '=', 'movies_genres.idMovie')
                    ->where('movies.id', '=', $idMovie)
                    ->get();

        
        return view('movies.show', compact('movie'))->with('genres', $genres);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $idMovie = $movie->id;
        $movie = Movie::find($movie->id);

        //Obtenemos todos los géneros de película
        $genres = \App\Genre::all();
        //Obtenemos los que previamente se capturaron en la creación de la película
        $selected_genres = DB::table('genres')
                    ->join('movies_genres', 'movies_genres.idGenre', '=', 'genres.id')
                    ->join('movies', 'movies.id', '=', 'movies_genres.idMovie')
                    ->where('movies.id', '=', $idMovie)
                    ->get();
        
        
        return view('movies.edit')->with('movie', $movie)->with('genres', $genres)->with('selected_genres', $selected_genres);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //get the id of the movie
        $idMovie = $movie->id;
        //we validate each field
        $request->validate([
            'name' => 'required',
            'duration' => 'required',
            'creators' => 'required',
            'rate' => 'required',
            'synopsis' => 'required'
        ]);
        //Make an update in the data of the movie
        Movie::whereId($movie->id)->update(request()->except(['_token', '_method', 'genres']));
        //We delete all the genres of the movie
        DB::table('movies_genres')->where('idMovie', '=', $idMovie)->delete();

        //We have to insert the new genres in the table movies_genres
        $genres = $request->input('genres');
        foreach ($genres as $genre) {
            \App\MovieGenre::create(['idMovie' => $idMovie,
                                'idGenre' => $genre,
                                ]);
        }

        return redirect()->route('movies.index')->with('message', 'The movie was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('message', 'The movie was successfully deleted.');
    }
}
