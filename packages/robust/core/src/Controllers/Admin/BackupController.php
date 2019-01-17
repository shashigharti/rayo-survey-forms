<?php

namespace Robust\Core\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Models\Backup;
use Robust\Core\Repositories\BackupRepository;


/**
 * Class BackupController
 * @package Robust\Core\Controllers\Admin
 */
class BackupController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * BackupController constructor.
     * @param Request $request
     * @param BackupRepository $backup
     */
    public function __construct(Request $request, BackupRepository $backup)
    {
        $this->model = $backup;
        $this->request = $request;
        $this->ui = 'Robust\Core\UI\Backup';
        $this->package_name = 'core';
        $this->view = 'admin.backup';
        $this->title = 'Back Up';


    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function backup()
    {

        Artisan::call('robust:backup');
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getDownload($id)
    {
        $file = Backup::where('id', '=', $id)->firstOrFail();
        $pathToFile = $file->path . $file->name;
        return response()->download($pathToFile);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $backup = $this->model->find($id);

        $exitCode = Artisan::call('robust:restore', [
            'user' => env('DB_USERNAME'),
            'schema' => env('DB_DATABASE'),
            'password' => env('DB_PASSWORD'),
            'file' => $backup->path . $backup->name
        ]);

        return redirect()->back();
    }
}