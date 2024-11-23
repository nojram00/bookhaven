<?php

namespace App\Services;

use Appwrite\Client;
use Appwrite\Enums\ImageFormat;
use Appwrite\Enums\ImageGravity;
use Appwrite\InputFile;
use Appwrite\Services\Storage;
use Exception;
use Illuminate\Support\Facades\Response;

class AppwriteStorageService
{
    protected $client;
    protected $storage;

    public function __construct()
    {
        $this->client = new Client();

        $this->client
            ->setEndpoint('https://cloud.appwrite.io/v1')
            ->setProject('674173760025cbc967be');

        $this->storage = new Storage($this->client);
    }

    public function upload_image($filepath, $bucketId = '674176ea001d6e463732')
    {
        try
        {
            $inputFile = InputFile::withPath($filepath);
            $result = $this->storage->createFile(
                $bucketId,
                uniqid(),
                $inputFile
            );

            return $result;
        }
        catch (Exception $e)
        {
            return ['error' => $e->getMessage()];
        }
    }

    public function get_image($fileId, $bucketId = '674176ea001d6e463732')
    {
        try
        {
            // $result = $this->storage->getFilePreview(
            //     $bucketId,
            //     $fileId,
            //     120,
            //     120,
            //     ImageGravity::CENTER(),$fileId, $bucketId = '674176ea001d6e463732'
            //     0,
            //     0,
            //     "FFFFFF",
            //     0,
            //     1,
            //     0,
            //     null
            // );

            $result = $this->storage->getFileView(
                $bucketId,
                $fileId,
            );

            $image = base64_encode($result);

            return ['image' => "data:image/png;base64, $image"];
        }
        catch(Exception $e)
        {
            return ['error' => $e->getMessage()];
        }
    }

    public static function GetImage($fileId, $bucketId = '674176ea001d6e463732')
    {

    }
}
