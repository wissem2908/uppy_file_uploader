<?php

// var_dump($_POST['name']);
// var_dump($_POST['caption']);
// var_dump($_FILES);
$filename = $_FILES['files']['name'][0];
$tmp_name = $_FILES['files']['tmp_name'][0];

move_uploaded_file($tmp_name, './uploads/' . $filename);