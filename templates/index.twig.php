{% include "parts/head.html" %}
        <br>
        <div class="row">
            <div class="col-md-9">
                <h3>Basics:</h3>
                <table class="table table-striped">
                    <thead>
                        <tr><th>Route Example</th><th>Respone</th><th>Test</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>/500</code></td>
                            <td>Renders a square with the specified size / Filetype: {{ config.default_image_type }}</td>
                            <td><a href="500" class="btn btn-default btn-sm"><i class="fa fa-file-image-o"></i></a></td>
                        </tr>
                        <tr>
                            <td><code>/500x200</code></td>
                            <td>Renders image with the specified size (height / width)</td>
                            <td><a href="500x200" class="btn btn-default btn-sm"><i class="fa fa-file-image-o"></i></a></td>
                        </tr>
                        <tr>
                            <td><code>/500.[{{ config.valid_image_types|join('|') }}]</code></td>
                            <td>Renders a square with the specified size / Filetype can be passed also!</td>
                            <td><a href="500.{{ config.valid_image_types.0 }}" class="btn btn-default btn-sm"><i class="fa fa-file-image-o"></i></a></td>
                        </tr>
                        <tr>
                            <td><code>/500x200.[{{ config.valid_image_types|join('|') }}]</code></td>
                            <td>Renders image with the specified size (height / width) | Filetype can be specified</td>
                            <td><a href="500x200.{{ config.valid_image_types.0 }}" class="btn btn-default btn-sm"><i class="fa fa-file-image-o"></i></a></td>
                        </tr>
                    </tbody>
                </table>
                <h3>Color it!</h3>
                {% if config.use_random_color == false %}
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        The hoster has disabled this option.
                    </div>
                {% endif %}
                <table class="table table-striped">
                    <thead>
                        <tr><th>Route Example</th><th>Respone</th><th>Test</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>/500x300/cd0</code></td>
                            <td>Will color (short hex) the background of the image <code>#cd0</code></td>
                            <td><a href="500x300/cd0" class="btn btn-default btn-sm"><i class="fa fa-file-image-o"></i></a></td>
                        </tr>
                        <tr>
                            <td><code>/500x300/df0000</code></td>
                            <td>Will color (hex) the background of the image <code>#df0000</code></td>
                            <td><a href="500x300/df0000" class="btn btn-default btn-sm"><i class="fa fa-file-image-o"></i></a></td>
                        </tr>
                        <tr>
                            <td><code>/500x300/222,0,0</code></td>
                            <td>Will color (rgb, values from 0-255) the background of the image <code>rgb(222, 0, 0)</code></td>
                            <td><a href="500x300/222,0,0" class="btn btn-default btn-sm"><i class="fa fa-file-image-o"></i></a></td>
                        </tr>
                    </tbody>
                </table>
                <h3>Add custom text</h3>
                <table class="table table-striped">
                    <thead>
                        <tr><th>Route Example</th><th>Respone</th><th>Test</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>/500x300/fd0/Hello World</code></td>
                            <td>Adds text <code>Hello World</code> to the first line (and paints the background)</td>
                            <td><a href="500x300/fd0/Hello World" class="btn btn-default btn-sm"><i class="fa fa-file-image-o"></i></a></td>
                        </tr>
                        <tr>
                            <td><code>/500x300.{{ config.valid_image_types.0 }}?text=Lorem Ipsum</code></td>
                            <td>Adds text <code>Lorem Ipsum</code> to the first line</td>
                            <td><a href="500x300.{{ config.valid_image_types.0 }}?text=Lorem Ipsum" class="btn btn-default btn-sm"><i class="fa fa-file-image-o"></i></a></td>
                        </tr>
                    </tbody>
                </table>
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