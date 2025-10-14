<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 - Page Not Found</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>

        body {

            margin: 0;

            font-family: 'Roboto', sans-serif;

            display: flex;

            justify-content: center;

            align-items: center;

            min-height: 100vh;

            background: #f4f4f4;

            color: #333;

        }



        .container {

            text-align: center;

            max-width: 600px;

            padding: 20px;

        }



        h1 {

            font-size: 6rem;

            margin: 0;

            color: #ff6b6b;

        }



        h2 {

            font-size: 2rem;

            margin: 10px 0;

        }



        p {

            font-size: 1.2rem;

            margin: 10px 0 30px;

            color: #555;

        }



        a {

            display: inline-block;

            padding: 10px 20px;

            font-size: 1rem;

            font-weight: bold;

            color: #fff;

            background: #ee454f;

            border-radius: 5px;

            text-decoration: none;

            transition: background 0.3s;

        }



        a:hover {

            background: #0056b3;

        }



        .illustration {

            max-width: 100%;

            height: auto;

            margin: 20px 0;

        }

    </style>

</head>

<body>

    <div class="container">

        <h1>404</h1>

        <h2>Page Not Found</h2>

        <p>Oops! The page you are looking for doesn't exist or has been moved.</p>

            @if (Request::is('admin/*'))
                <a href="{{ url('/home') }}">Go Back to Home</a>
            @else
                <a href="{{ url('/') }}">Go Back to Home</a>
            @endif


    </div>

</body>

</html>

