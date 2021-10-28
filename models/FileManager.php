<?php

class FileManager
{
    private $destinationPath;
    private $errorMessage;
    private $extensions;
    private $maxSize;
    private $uploadName;
    public $name = 'Uploader';

    function setDir($path)
    {
        $this->destinationPath = $path;
    }

    function setMaxSize($sizeMB)
    {
        $this->maxSize = $sizeMB * (1024 * 1024);
    }

    function setExtensions($options)
    {
        $this->extensions = $options;
    }

    function setMessage($message)
    {
        $this->errorMessage = $message;
    }

    function getMessage()
    {
        return $this->errorMessage;
    }

    function getUploadName()
    {
        return $this->uploadName;
    }

    function uploadFile($fileBrowse)
    {
        $result = false;
        $size = $fileBrowse["size"];
        $name = $fileBrowse["name"];
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        $this->uploadName = $this->random_string(10).'.'.$ext;

        if (empty($name)) {
            $this->setMessage("File not selected ");
        } else if ($size > $this->maxSize) {
            $this->setMessage("Too large file !");
        } else if (in_array($ext, $this->extensions)) {
            if (!is_dir($this->destinationPath))
                mkdir($this->destinationPath);
            if (!is_dir($this->destinationPath . '/' . $ext))
                mkdir($this->destinationPath . '/' . $ext);

            if (file_exists($this->destinationPath . '/' . $ext . '/' . $this->uploadName))
                $this->setMessage("File already exists. !");
            else if (!is_writable($this->destinationPath . '/' . $ext))
                $this->setMessage("Destination is not writable !");
            else {
                if (move_uploaded_file($fileBrowse["tmp_name"], $this->destinationPath . '/' . $this->uploadName)) {
                    $result = true;
                } else {
                    $this->setMessage("Upload failed , try later !");
                }
            }
        } else {
            $this->setMessage("Invalid file format !");
        }
        return $result;
    }

    function deleteUploaded($fileBrowse)
    {
        $name = $_FILES[$fileBrowse]["name"];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        unlink($this->destinationPath . '/' . $ext . '/' . $this->uploadName);
    }

    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
}



?>