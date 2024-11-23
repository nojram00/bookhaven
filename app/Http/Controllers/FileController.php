<?php

namespace App\Http\Controllers;

use App\Services\AppwriteStorageService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $appwriteStorage;
    public function __construct(AppwriteStorageService $appwriteStorageService)
    {
        $this->appwriteStorage = $appwriteStorageService;
    }

    public function index($fileId)
    {
        $result = $this->appwriteStorage->get_image($fileId);

        // dd($result);
        if(isset($result['error']))
        {
            dd($result['error']);
            abort(404);
        }

        return response()->json($result);
    }
}
