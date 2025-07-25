<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasedEngine;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $engines = BasedEngine::orderBy('position')->get();
        $engine = BasedEngine::find($request->get('engine')) ?? $engines->first();
        $query = $request->get('q');

        // Save recent searches
        if ($query) {
            $recent = session('recent_searches', []);
            array_unshift($recent, $query);
            $recent = array_unique($recent);
            $recent = array_slice($recent, 0, 5);
            session(['recent_searches' => $recent]);
        }

        // Instant Answer (DuckDuckGo)
        $instantAnswer = null;
        if ($query) {
            $response = Http::get('https://api.duckduckgo.com/', [
                'q' => $query,
                'format' => 'json',
                'no_redirect' => 1,
                'no_html' => 1,
            ]);

            $data = $response->json();
            if (!empty($data['AbstractText'])) {
                $instantAnswer = [
                    'text' => $data['AbstractText'],
                    'title' => $data['Heading'] ?? '',
                    'url' => $data['AbstractURL'] ?? '',
                    'image' => $data['Image'] ?? null,
                ];
            }
        }

        $searchUrl = null;
        if ($query && $engine) {
            $searchUrl = "https://cse.google.com/cse?cx={$engine->cx}&q=" . urlencode($query);
        }

        return view('search', [
            'engines' => $engines,
            'activeEngine' => $engine,
            'query' => $query,
            'searchUrl' => $searchUrl,
            'instantAnswer' => $instantAnswer,
            'recentSearches' => session('recent_searches', []),
            'popularSearches' => ['Laravel Tips', 'AI Tools', 'How to cook', 'HTML vs CSS', 'Latest tech news']
        ]);
    }

    public function redirect(Request $request)
    {
        $engine = BasedEngine::find($request->get('engine'));
        $query = $request->get('q');

        if (!$engine || !$query) {
            return redirect()->back()->with('error', 'Missing search input.');
        }

        $searchUrl = "https://cse.google.com/cse?cx={$engine->cx}&q=" . urlencode($query);
        return redirect()->away($searchUrl);
    }
}
