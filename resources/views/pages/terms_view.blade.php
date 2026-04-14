<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <style>
        body { background: #f4f7fb; }
        .terms-container { max-width: 800px; margin: 50px auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .content { line-height: 1.8; color: #555; }
    </style>
</head>
<body>
    <div class="terms-container">
        <h2 class="mb-4 text-center">Terms and Conditions</h2>
        <hr class="mb-5">
        <div class="content">
            {!! $content->value ?? '<p class="text-center text-muted">Terms and conditions are currently unavailable.</p>' !!}
        </div>
        <div class="text-center mt-5">
            <a href="javascript:window.close();" class="btn btn-primary text-white">Close Window</a>
        </div>
    </div>
</body>
</html>
