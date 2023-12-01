{{-- You are reading the post with id ={{$id}}
{{$post}} --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Post Detail</title>
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
            <img src="path/to/author-image.jpg" alt="Author Image" class="author-image">
            <span class="author-name">Author Name</span>
        </div>
        <p class="full-description">
        {{$post->full_description}}    
        
        </p>
    </div>
</body>

</html>
