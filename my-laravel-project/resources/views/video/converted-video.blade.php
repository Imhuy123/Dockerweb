<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Converter</title>
    <style>
        video {
            width: 100%;
            max-width: 600px;
            margin: 20px 0;
            border: 1px solid #ddd;
        }
        .video-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
    </style>
</head>
<body>
    <h1>Video đã chuyển đổi</h1>
    <div class="video-container">
        @foreach ($videos as $video)
            <div>
                <h2>{{ basename($video) }}</h2>
                <video controls>
                    <source src="{{ asset('video/' . basename($video)) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endforeach
    </div>
</body>
</html>
