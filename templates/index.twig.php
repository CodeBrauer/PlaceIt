{% include "parts/head.html" %}
        <br>
        <div class="row">
            <div class="col-md-9">
                <h3>Basics:</h3>
                <table class="table table-striped">
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
                <h3>Add custom text</h3>
                <table class="table table-striped">
                    <thead>
                        <tr><th>Route Example</th><th>Respone</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>/500x300/Hello World</code></td>
                            <td>Adds text <code>Hello World</code> to the first line</td>
                        </tr>
                        <tr>
                            <td><code>/500x300.{{ config.valid_image_types.0 }}?text=Lorem Ipsum</code></td>
                            <td>Adds text <code>Lorem Ipsum</code> to the first line</td>
                        </tr>
                    </tbody>
                </table>
                <h3>Color it!</h3>
                <em>Not possible yet.</em>
            </div>
            <div class="col-md-3">
                <p class="text-center">
                    <img src="250.png" class="img-thumbnail img-responsive preview-thumb">
                    <br><br>
                    <a class="btn btn-default refresh-btn"><i class="fa fa-refresh"></i></a>
                </p>
            </div>
        </div>
{% include "parts/footer.html" %}