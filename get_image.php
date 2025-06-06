<?php
function get_image($fieldName = 'photo', $folder = 'uploads')
{
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $name = basename($_FILES[$fieldName]['name']);
    $targetDir = __DIR__ . '/' . trim($folder, '/');

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0775, true);
    }

    $target = $targetDir . '/' . $name;

    if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $target)) {
        return $name;
    }

    return null;
}
