<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h1>Hello this is a new HomePage</h1>

    <p>A great bumber is {{2 + 2}} </p>
    <p>The current date is {{date('Y')}} </p>

    <p> {{$name}} has a cat named {{$catname}}</p>

    <ul>
        @foreach ($allAnimals as $animal)
        <li>{{$animal}}</li>
        @endforeach
    </ul>

    <h1><a href="/about">About</a></h1>
</body>
</html>