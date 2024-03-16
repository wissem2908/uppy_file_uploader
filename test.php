<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uppy.io Image Upload</title>
    <!-- Include Uppy.io CSS -->
    <link rel="stylesheet" href="./uppy core/dist/uppy.min.css">
</head>
<body>
    <h1>Uppy.io Image Upload</h1>
    <form id="uploadForm">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age">
        </div>
        <div>
            <label for="image">Image:</label>
            <!-- Uppy.io file upload target -->
            <div id="uppy"></div>
        </div>
        <button type="submit">Submit</button>
    </form>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Uppy.io JavaScript -->
    <script src="./uppy core/dist/uppy.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Uppy with Dashboard
            const uppy = new Uppy.Core({
                autoProceed: false,
                restrictions: {
                    maxNumberOfFiles: 1,
                    allowedFileTypes: ['image/*']
                }
            }).use(Uppy.Dashboard, {
                inline: true,
                target: '#uppy'
            });


            uppy.setOptions({
        showProgressDetails: true, // Ensure progress details are shown even if the upload button is disabled
        disabled: true
    });
            // Handle form submission
            $('#uploadForm').submit(function(event) {
                event.preventDefault();

                // Get form data
                const formData = new FormData(this);
                uppy.getFiles().forEach(file => {
                    formData.append('files[]', file.data);
                });

                // Example: Log form data to console
                for (const [name, value] of formData.entries()) {
                    console.log(`${name}: ${value}`);
                }

                // Send formData to your server using AJAX
                $.ajax({
                    url: './upload.php',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        console.log('Upload successful:', response);
                        // Handle success response
                        const data = JSON.parse(response);
                        if (data.reponse === "false" && data.message === 1) {
                            $('.required').show();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Enter required fields!'
                            });
                        } else if (data.reponse === "false" && data.message === 2) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'File is not an image'
                            });
                        } else if (data.reponse === "false" && data.message === 4) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Ad title should not contain special character'
                            });
                        } else if (data.reponse === "true") {
                            $('.required').hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Ad placed successfully',
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Upload failed:', error);
                        // Handle error response
                    }
                });
            });
        });
    </script>
</body>
</html>
