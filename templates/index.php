<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PlaceIt</title>
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>{{ config.app_name }} <small>{{ config.app_slogan }}</small></h1>
        </div>
        <br>
        <div class="row">
            <div class="col-md-9">
                <h3>Possible calls:</h3>
                <table class="table">
                    <thead>
                        <tr><th>Route</th><th>Respone</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>/500</code></td>
                            <td>Renders a square with the specified size / Filetype: {{ config.default_image_type }}</td>
                        </tr>
                        <tr>
                            <td><code>/500x200</code></td>
                            <td>Renders image with the specified size (height / width)</td>
                        </tr>
                        <tr>
                            <td><code>/500.[{{ config.valid_image_types|join('|') }}]</code></td>
                            <td>Renders a square with the specified size / Filetype can be passed also!</td>
                        </tr>
                        <tr>
                            <td><code>/500x200.[{{ config.valid_image_types|join('|') }}]</code></td>
                            <td>Renders image with the specified size (height / width) | Filetype can be specified</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <img src="300.png" class="img-thumbnail img-responsive">
            </div>
        </div>
    </div>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>