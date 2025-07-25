{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nexify - Explore Smarter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #202124;
            color: white;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .search-box {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 20vh;
        }
        .search-input {
            border-radius: 30px;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1.2rem;
            width: 100%;
        }
        .search-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="text-center mt-5">
        <h1 style="font-size: 4rem; font-weight: bold;">Nexify</h1>
        <p class="text-muted">Search smarter, faster, better.</p>
    </div>

    <div class="search-box">
        <form action="{{ route('search.page') }}" method="GET">
            <input type="text" name="query" placeholder="Search the web..." class="search-input">
            <div class="text-center">
                <button type="submit" class="btn btn-light search-btn">Nexify Search</button>
            </div>
        </form>
    </div>
</body>
</html>
