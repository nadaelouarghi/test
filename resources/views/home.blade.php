<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @auth <!--if the user is logged in -->
    <p>congrats you are logged in </p>
    <form action='/logout' method='POST'>
    @csrf
    <button>log out </button>
    </form>
    <div style="border:3px solid black;">
        <h2>create a new post </h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="title">
            <textarea name="body" placeholder="body content.."></textarea>
            <button> save post </button>

        </form>
    </div>
    <div style="border:3px solid black;">
    <h2>all posts</h2>

    @foreach($posts as $post)
    <div style="background-color:gray ;padding:10px;margin:10px">
    <h3> {{ $post['title'] }}</h3>
    {{ $post['body'] }}

    <p> <a href="/edit-post/{{ $post->id }}">Edit</a></p>
    <form action="/delete-post/{{$post->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button>delete</button>

    </form>
    </div>
    @endforeach
    </div>

    @else
    <div style="border:3px solid black;">
        <h2>register</h2>
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="name">
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <button>register</button>
        </form>
    </div>
    <div style="border:3px solid black;">
        <h2>login</h2>
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="loginname" placeholder="name">
            <input type="password" name="loginpassword" placeholder="password">
            <button>log in</button>
        </form>
    </div>
    @endauth

</body>
</html>
