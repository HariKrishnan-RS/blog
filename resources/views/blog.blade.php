<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="{{ asset('style.css') }}" rel="stylesheet">

</head>
<body>
@auth
    @if(auth()->user()->role === 'admin')
        <p>Welcome Admin!</p>
    @elseif(auth()->user()->role === 'editor')
        <p>Welcome editor!</p>
    @else
        <p>Welcome User!</p>
    @endif
@endauth


@if(session('login_message'))
    <div class="alert">
        {{ session('login_message') }}
    </div>
@endif

@if(session('logout_message'))
    <div class="alert">
        {{ session('logout_message') }}
    </div>
@endif


<nav class="navbar navbar-expand-lg navbar-light bg-light top-nav">
  <a class="navbar-brand" href="#">BlogPage</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse link-list-div" id="navbarNav">
    <ul class="navbar-nav link-list">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
  </div>
</nav>




<div class="blog-img-div">
<img class="blog-img" src="{{ asset('images/blog-img.jpg') }}" alt="blog">
<p class="my-blog-title">My Blog</p>
</div>
   


  <div class = "m-4 gap-4 card-pack">
    

@foreach($posts as $post)
    <div class="card">
        <img src="{{ asset('images/post-img.jpg') }}" class="card-img" alt="Placeholder Image">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->small_description }}</p>
            <!-- If you want to display the full description in the card: -->
            <!-- <p class="card-text">{{ $post->full_description }}</p> -->
            <a href="{{ route('read.page', ['id' => $post->id]) }}" class="btn btn-primary">Read</a>
        </div>
    </div>
@endforeach



    </div>

<form method="POST" action="{{ route('blog.page') }}">
    @csrf
    <button class="btn-secondary" type="submit">Logout</button>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>