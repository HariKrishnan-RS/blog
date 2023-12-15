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
        .scrollable-div {
    max-height: 300px; 
    overflow-y: auto;
    overflow-x:hidden;
    border: 1px solid #ccc; 
    border-radius: 5px;
    }

    .row {
        padding: 10px;
        border-bottom: 1px solid #eee; 
    }

   
    .row h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 600;
        color:rgb(255, 123, 0);
    }

    .row p {
        margin: 5px 0 0;
        font-size: 15px;
    }
    .scrollable-div::-webkit-scrollbar {
    width: 6px; 
    }

    .scrollable-div::-webkit-scrollbar-track {
        background-color: #f1f1f1; 
    }
    .scrollable-div::-webkit-scrollbar-thumb {
        background-color: rgb(218, 218, 218); 
        border-radius: 3px;
    }
    .date {
        font-size: 12px !important;
        color:grey;
        text-align: end;
    }

    </style>
</head>

<body>
  
    <div class="post">
        <h1 class="post-title">{{$post->title}}</h1>
        <img src="{{ asset('images/post-img.jpg') }}" alt="Post Image" class="post-image">
        @if(session('addedComment'))
            <div class="alert alert-success mt-1" role="alert">
            {{ session('addedComment') }}
            </div>
        @endif
        <div class="author">
            <img src="{{ asset('images/user.png') }}" alt="Author Image" class="author-image">
            
            <span class="author-name">{{$user_name}}</span>
        </div>
        <p class="full-description">
        {{$post->full_description}}    
        </p>
        <div class="scrollable-div">
            @foreach($comments as $comment)
                <div class="row">
                    <h3>{{($comment->user->name)}}</h3>
                    <p>{{$comment->comment}}</p>
                    @if($comment->created_at)
                    <p class="date"> posted: {{ $comment->created_at->diffForHumans() }}</p>
                    @endif
                </div>
            @endforeach
        </div>
        <div>
                <form class="form" method="POST" action="{{ route('read.page',['id'=>$post->id]) }}">
                @csrf

                    <label class="comment-label" for="comment">Your Comment:</label>
                    <input type="text" class="form-control" id="comment" name="comment" required >
                    <button class="btn btn-primary mt-1"  type="submit" name='commentbtn' >Add Comment</button>

                </form>
        </div>
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
