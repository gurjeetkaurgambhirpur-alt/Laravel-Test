<!DOCTYPE html>
<html>
<head>
    <title>Movie Cast</title>
    <style>
        .cast-container {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 10px;
            white-space: nowrap;
        }

        .cast-card {
            flex: 0 0 auto;
            width: 150px;
            text-align: center;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 10px;
        }

        img {
            width: 100px;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
        }

        h2 {
            margin: 10px 0;
        }
    </style>
</head>
<body>
@if(!empty($movie['image']) && $movie['image'] !== 'N/A')
<div>
    <img src="{{ $movie['image'] }}" alt="{{ $movie['title'] }}" style="width:200px;height:auto;border-radius:8px;" />
</div>
@endif
<h2>{{ $movie['title'] }}</h2>
<h2>{{ $movie['description'] }}</h2>
<h2>{{ $movie['author'] }}</h2>
<div class="cast-container">
    @foreach($movie['cast'] as $cast)
        <div class="cast-card">
            <img src="{{ $cast['image'] ?? 'https://via.placeholder.com/100x130' }}" alt="Actor Image">
            <p><strong>{{ $cast['actor'] }}</strong></p>
            <p>{{ $cast['character'] }}</p>
        </div>
    @endforeach
</div>

</body>
</html>
