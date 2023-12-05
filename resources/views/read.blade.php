{{-- You are reading the post with id ={{$id}}
{{$post}} --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Post Detail</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
        /* Basic styles for layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .post {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .post-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .post-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .author {
            display: flex;
            align-items: center;
        }

        .author-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .author-name {
            font-weight: bold;
        }

        .full-description {
            line-height: 1.6;
        }
    </style>
</head>

<body>
  
    <div class="post">
        <h1 class="post-title">{{$post->title}}</h1>
        <img src="{{ asset('images/post-img.jpg') }}" alt="Post Image" class="post-image">
        <div class="author">
            <img src="{{ asset('images/user.png') }}" alt="Author Image" class="author-image">
            <span class="author-name">{{$user_name}}</span>
        </div>
        <p class="full-description">
        {{$post->full_description}}    
        
        </p>

    <div>

    @auth
        @if(auth()->user()->role === 'admin' && !$post->approved)
        <form method="POST" action="{{ route('read.page',['id'=>$post->id]) }}">
            @csrf
            <button class="btn btn-success mt-1"  type="submit">Approve</button>
            </form>
        @endif
        @if(auth()->user()->role === 'admin' && $post->approved)
        <form method="POST" action="{{ route('read.page',['id'=>$post->id]) }}">
            @csrf
            <button class="btn btn-danger mt-1"  type="submit" name="delete">Delete</button>
            </form>
        @endif

        @if(auth()->user()->role === 'editor')
            <form method="GET" action="{{ route('edit.page',['id'=>$post->id]) }}">
            @csrf
            <button class="btn btn-warning mt-1"  type="submit">Edit</button>
            </form>
        @endif
    @endauth
        
    </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
