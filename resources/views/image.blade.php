<!DOCTYPE html>
<html>
<head>
    <title>{{ $image->name }}</title>
    <style>
        img.responsive {
            /* This will make the image width 100% of the window up to a maximum of 800px */
            max-width: 800px;
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<img class="responsive" src="{{ url('/' . $image->path) }}" alt="Your Image">
</body>
</html>
