<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $typesPt = [];
        $statsPt = [];
        $details = null;
        $paginator = null;
        $navigationData = null;

        if ($search) {
            // Busca por nome
            $url = "https://pokeapi.co/api/v2/pokemon/" . strtolower($search);
            $response = Http::get($url);
            if ($response->successful()) {
                $details = $response->json();
                
                // Obter lista completa de Pokémons para navegação
                $responseAll = Http::get('https://pokeapi.co/api/v2/pokemon?limit=10000');
                $allPokemons = $responseAll->successful() ? $responseAll->json()['results'] : [];
                $currentIndex = array_search(strtolower($search), array_column($allPokemons, 'name'));
                
                if ($currentIndex !== false) {
                    // Preparar dados de navegação
                    $navigationData = [
                        'current' => $search,
                        'currentIndex' => $currentIndex,
                        'total' => count($allPokemons),
                        'previous' => $currentIndex > 0 ? $allPokemons[$currentIndex - 1]['name'] : null,
                        'next' => $currentIndex < count($allPokemons) - 1 ? $allPokemons[$currentIndex + 1]['name'] : null
                    ];
                }
                
                // Tipos em português
                foreach ($details['types'] as $typeInfo) {
                    $typeData = Http::get($typeInfo['type']['url'])->json();
                    $ptName = null;
                    foreach ($typeData['names'] as $name) {
                        if ($name['language']['name'] === 'pt') {
                            $ptName = $name['name'];
                            break;
                        }
                    }
                    $typesPt[] = $ptName ?? $typeInfo['type']['name'];
                }
                
                // Status em português
                foreach ($details['stats'] as $statInfo) {
                    $statData = Http::get($statInfo['stat']['url'])->json();
                    $ptName = null;
                    foreach ($statData['names'] as $name) {
                        if ($name['language']['name'] === 'pt') {
                            $ptName = $name['name'];
                            break;
                        }
                    }
                    $statsPt[] = $ptName ?? $statInfo['stat']['name'];
                }
            } else {
                // Pokémon não encontrado
                $details = null;
                $typesPt = [];
                $statsPt = [];
                $paginator = null;
                $navigationData = null;
            }
        } else {
            // Listagem paginada
            $page = $request->input('page', 1);
            $offset = ($page - 1) * 1;

            $url = "https://pokeapi.co/api/v2/pokemon?offset={$offset}&limit=1";
            $response = Http::get($url);
            $data = $response->json();

            $pokemons = $data['results'];
            $total = $data['count'];

            $details = Http::get($pokemons[0]['url'])->json();

            // Tipos em português
            foreach ($details['types'] as $typeInfo) {
                $typeData = Http::get($typeInfo['type']['url'])->json();
                $ptName = null;
                foreach ($typeData['names'] as $name) {
                    if ($name['language']['name'] === 'es') {
                        $ptName = $name['name'];
                        break;
                    }
                }
                $typesPt[] = $ptName ?? $typeInfo['type']['name'];
            }

            // Status em português
            foreach ($details['stats'] as $statInfo) {
                $statData = Http::get($statInfo['stat']['url'])->json();
                $ptName = null;
                foreach ($statData['names'] as $name) {
                    if ($name['language']['name'] === 'es') {
                        $ptName = $name['name'];
                        break;
                    }
                }
                $statsPt[] = $ptName ?? $statInfo['stat']['name'];
            }

            $paginator = new LengthAwarePaginator(
                $pokemons,
                $total,
                1,
                $page,
                ['path' => url()->current()]
            );
        }

        return view('pokemons.index', [
            'paginator' => $paginator,
            'details' => $details,
            'types' => $typesPt,
            'stats' => $statsPt,
            'navigationData' => $navigationData,
        ]);
    }

    public function show($name)
    {
        $typesPt = [];
        $statsPt = [];
        $details = null;

        $url = "https://pokeapi.co/api/v2/pokemon/" . strtolower($name);
        $response = Http::get($url);
        if ($response->successful()) {
            $details = $response->json();
            // Tipos em português
            foreach ($details['types'] as $typeInfo) {
                $typeData = Http::get($typeInfo['type']['url'])->json();
                $ptName = null;
                foreach ($typeData['names'] as $typeName) {
                    if ($typeName['language']['name'] === 'es') {
                        $ptName = $typeName['name'];
                        break;
                    }
                }
                $typesPt[] = $ptName ?? $typeInfo['type']['name'];
            }
            // Status em português
            foreach ($details['stats'] as $statInfo) {
                $statData = Http::get($statInfo['stat']['url'])->json();
                $ptName = null;
                foreach ($statData['names'] as $name) {
                    if ($name['language']['name'] === 'es') {
                        $ptName = $name['name'];
                        break;
                    }
                }
                $statsPt[] = $ptName ?? $statInfo['stat']['name'];
            }
        }
        return view('pokemons.index', [
            'paginator' => null,
            'details' => $details,
            'types' => $typesPt,
            'stats' => $statsPt,
        ]);
    }

    public function autocomplete(Request $request)
    {
        $query = strtolower($request->input('q', ''));
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=1000');
        $results = [];

        if ($response->successful()) {
            $pokemons = $response->json()['results'];
            foreach ($pokemons as $pokemon) {
                if (strpos($pokemon['name'], $query) !== false) {
                    $results[] = $pokemon['name'];
                }
            }
        }

        return response()->json($results);
    }
}
