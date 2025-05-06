<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container mt-4">
        <form action="{{ route('search') }}" method="GET">
            <div class="mb-3">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Введите 3 иои более символа">
                    <button type="submit" id="searchButton" class="btn btn-success">Search</button>
                </div>
            </div>
        </form>
        @if (isset($results))
            @if ($results->isNotEmpty())
                <h5>Results:</h5>
                <ul class="list-group">
                    @foreach ($results as $post)
                        <li class="list-group-item">
                            <h1>{{ $post->title }}</h1>
                            @foreach ($post->comments as $comment)
                                <p>{{ $comment->body }}</p>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            @else
            <p>Нет результата</p>
            @endif
        @endif
    </div>

</body>

</html>
