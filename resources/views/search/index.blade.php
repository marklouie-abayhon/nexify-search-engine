@extends('layouts.app')

@section('title', 'Nexify Search')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h1 class="fw-bold display-5">Discover the Web with Nexify</h1>
        <p class="text-muted">Search the entire web or just specific areas with precision</p>
    </div>

    <form id="searchForm" method="GET" class="input-group mb-4 position-relative">
        <input type="text" id="searchInput" name="q" value="{{ request('q') }}" class="form-control form-control-lg" placeholder="Type your search..." autocomplete="off" required>
        <input type="hidden" id="cxInput" name="cx" value="34eef687ce269487c">
        <button type="submit" class="btn btn-primary btn-lg">Search</button>
        <div id="autocompleteBox" class="position-absolute w-100 bg-white border rounded shadow-sm" style="top: 100%; z-index: 1000; display: none;"></div>
    </form>

    @php
        $engines = [
            'web' => '34eef687ce269487c',
            'images' => '954a56c1e00db57aa',
            'videos' => '530b5e7ca4f8045d4',
            'news' => 'b16521454a1884f6a',
            'torrents' => '6ff7034d0894868ee',
            'subtitles' => '93314d2add702dbab',
        ];
        $tab = request('tab', 'web');
        $recentSearches = session('recent_searches', []);
    @endphp

    <ul class="nav nav-tabs mb-3 justify-content-center" id="tab-nav">
        @foreach ($engines as $name => $id)
            <li class="nav-item">
                <a class="nav-link {{ $tab === $name ? 'active' : '' }}" href="#" onclick="event.preventDefault(); setTab('{{ $id }}')">
                    {{ ucfirst($name) }}
                </a>
            </li>
        @endforeach
    </ul>

    @if (!empty($recentSearches))
        <div class="mt-5">
            <h5 class="mb-3">Recent Searches</h5>
            <ul class="list-group">
                @foreach (array_reverse($recentSearches) as $item)
                    <li class="list-group-item"><a href="#" onclick="searchFromHistory('{{ $item }}')" class="text-decoration-none">{{ $item }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
const searchInput = document.getElementById('searchInput');
const autocompleteBox = document.getElementById('autocompleteBox');
const searchForm = document.getElementById('searchForm');
const cxInput = document.getElementById('cxInput');

function setTab(cx) {
    cxInput.value = cx;
    performSearch();
}

function performSearch() {
    const q = searchInput.value.trim();
    const cx = cxInput.value;
    if (!q) return;
    window.open(`https://cse.google.com/cse?cx=${cx}&q=${encodeURIComponent(q)}`, '_blank');
}

function searchFromHistory(query) {
    searchInput.value = query;
    performSearch();
}

searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
    performSearch();
});

searchInput.addEventListener('input', async () => {
    const query = searchInput.value.trim();
    if (query.length < 2) {
        autocompleteBox.style.display = 'none';
        return;
    }

    const res = await fetch(`https://duckduckgo.com/ac/?q=${encodeURIComponent(query)}`);
    const data = await res.json();

    if (!data.length) {
        autocompleteBox.style.display = 'none';
        return;
    }

    autocompleteBox.innerHTML = '';
    data.forEach(item => {
        const div = document.createElement('div');
        div.classList.add('p-2', 'autocomplete-item');
        div.style.cursor = 'pointer';
        div.innerText = item.phrase;
        div.onclick = () => {
            searchInput.value = item.phrase;
            autocompleteBox.style.display = 'none';
            performSearch();
        };
        autocompleteBox.appendChild(div);
    });
    autocompleteBox.style.display = 'block';
});

document.addEventListener('click', (e) => {
    if (!autocompleteBox.contains(e.target) && e.target !== searchInput) {
        autocompleteBox.style.display = 'none';
    }
});
</script>
@endpush
