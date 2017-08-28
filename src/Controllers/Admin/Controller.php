<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Qiniu\Auth as QiniuAuth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function qiniuUptoken()
    {
        $qiniu = new QiniuAuth(
            config('services.qiniu.access_key'),
            config('services.qiniu.secret_key')
        );
        return $qiniu->uploadtoken(config('services.qiniu.bucket'));
    }
}
