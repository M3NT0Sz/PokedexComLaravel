<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokemons', [PokemonController::class, 'index'])->name('pokemons.index');
Route::get('/pokemons/{name}', [PokemonController::class, 'show'])->name('pokemons.show');
Route::get('/pokemons-autocomplete', [\App\Http\Controllers\PokemonController::class, 'autocomplete'])->name('pokemons.autocomplete');
