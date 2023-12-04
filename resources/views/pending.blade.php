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
    @if(session('approve'))
    <div >
        {{ session('approve') }}
    </div>
@endif
@foreach($posts as $post)
@if(!$post->approved && !$post->draft)
    <div class="card m-5 " style="max-width:300px"  >
        <img src="{{ asset('images/post-img.jpg') }}" class="card-img card-img-top" alt="Placeholder Image">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->small_description }}</p>
            <!-- If you want to display the full description in the card: -->
            <!-- <p class="card-text">{{ $post->full_description }}</p> -->
            <a href="{{ route('read.page', ['id' => $post->id]) }}" class="btn btn-primary">Read</a>
        </div>
    </div>
@endif
@endforeach


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>