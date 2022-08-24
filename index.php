<html>
    <head>
        <title>Scan QR Code</title>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <script type="text/javascript" src="assets/js/instascan.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h4>QR Code Scanner</h4>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <video id="preview" width="100%"></video>
                </div>
                <div class="col-md-6">
                    <label>QR Code Value</label>
                    <input type="text" class="form-control" name="text" id="text" readonly >
                </div>
            </div>
        </div>

        <script type="text/javascript">
            let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
            scanner.addListener('scan', function (content) {
                document.getElementById('text').value = content;

                let value = { value: content};
                //console.log(value);
                let request = new XMLHttpRequest();

                request.open("POST","insertQRValue.php");

                request.onload = () => {
                    console.log(request.status);
                    console.log(request.statusText);
                    console.log(request.response);
                };

                request.onerror = (err) => {
                    console.log(err);
                    console.log(request.statusText);
                    console.log(request.status);
                }

                request.setRequestHeader('Content-Type', 'application/json');
                request.send(JSON.stringify(value));
            });

            Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
            }).catch(function (e) {
            console.error(e);
            });
        </script>
    </body>
</html>
