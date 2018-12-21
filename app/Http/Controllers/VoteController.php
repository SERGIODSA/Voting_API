<?php

namespace App\Http\Controllers;

use App\Fruit;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Fruit::with('votes')->get()->transform(function ($item, $key) {
            $itemArray = $item->toArray();
            $itemArray['votes'] = count($itemArray['votes']);
            return $itemArray;
        })->toArray();  

        usort($results, function ($a, $b) { return $b['votes'] - $a['votes']; });

        return Response()->json($results, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fruit $fruit)
    {
        if(!count(Auth::User()->vote)){
            $vote = Vote::create(['fruit_id' => $fruit->id]);
            $vote->user()->save(Auth::user());

            return Response()->json(['message' => 'success'], 201);
        }

        return Response()->json(['message' => 'user already voted'], 400);
    }

}
