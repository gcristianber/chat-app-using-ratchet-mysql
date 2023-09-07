<?php

class UploadGuard
{
    protected $allowedSize = 10000000;
    protected $allowedTypes = ["jpg", "png", "docx", "pdf", "xlsx"];
    protected $errors = [];

    public function upload($file)
    {
        if ($file["error"] !== UPLOAD_ERR_OK) {
            $this->errors["file_upload"] = "File upload failed with error code: " . $file["error"];
        } else {
            $extension = pathinfo($file["name"], PATHINFO_EXTENSION);

            if ($file["size"] > $this->allowedSize) {
                $this->errors["file_size"] = "File is too large!";
            } elseif (!in_array($extension, $this->allowedTypes)) {
                $this->errors["file_type"] = "Image type is not valid! (" . implode(", ", $this->allowedTypes) . ")";
            } else {
                $destination = "uploads/" . $file["name"];
                if (move_uploaded_file($file["tmp_name"], $destination)) {
                    return true;
                } else {
                    $this->errors["file_upload"] = "Failed to move the uploaded file.";
                }
            }
        }

        return $this->errors;
    }
}
