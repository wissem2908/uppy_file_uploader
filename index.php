<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files with Uppy</title>
    <link rel="stylesheet" href="./uppy core/dist/uppy.min.css">
</head>
<body>
    <h2 style="text-align:center">UPLOAD FILES TO THE SERVER WITH UPPY</h2>
    <div class="uppy-container">

    </div>

    <h4>UPLOADED FILES PREVIEW</h4>
    <div class="uploaded-files" style="width: 100%">
        <?php
            foreach (scandir('./uploads/') as $dir) {
                if ($dir == '.' || $dir == '..') {
                    continue;
                } ?>
        <div class="preview-cont" style="display: inline-block; width: 25%">
            <img src="./uploads/<?php echo $dir; ?>" alt="" style="width: 100%; height:auto">
        </div>
        <?php    } ?>
    </div>

    <script src="./uppy core/dist/uppy.min.js"></script>
    <script src="./index.js"></script>
</body>
</html>