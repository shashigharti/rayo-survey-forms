<?php
namespace Robust\Core\Controllers\Admin;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Common\Traits\CrudTrait;
use Robust\Core\Controllers\Common\Traits\ViewTrait;
use Robust\Core\Helpers\MenuHelper;
use Robust\Core\Repositories\Admin\MediaRepository;
/**
 * Class MediaController
 * @package Robust\Core\Controllers\Admin
 */
class MediaController extends Controller
{
    use ViewTrait, CrudTrait;
    /**
     * MediaController constructor.
     * @param MediaRepository $model
     */
    public function __construct(
        MediaRepository $model
    ) {
        $this->model = $model;
        $this->ui = 'Robust\Core\UI\Media';
        $this->package_name = 'core';
        $this->view = 'admin.core';
        $this->title = 'Medias';
        $this->table = 'core::admin.medias.media';
        $this->redirect = 'admin.medias';
        $this->ajax_view = 'admin.medias.ajax';
    }
    /**
     * @return $this
     */
    public function index()
    {
        $records = $this->model->orderBy('id', 'desc')->where('type', 'image')->paginate(settings('app-setting',
            'pagination'));
        return $this->display($this->table,
            [
                'records' => $records,
                'primary_menu' => (new MenuHelper())->getPrimaryMenu($this->package_name),
                'title' => (isset($this->title)) ? $this->title : '',
                'package' => $this->package_name,
            ]
        );
    }
    /**
     * @param Filesystem $file
     * @param MediaRepository $media
     */
    public function resetAll(Filesystem $file, MediaRepository $media)
    {
        $files = $file->allFiles(storage_path() . '/uploads');
        foreach ($files as $file) {
            $folders = explode("/", $file->getRelativePath());
            $id = $folders[count($folders) - 1];
            unset($folders[count($folders) - 1]);
            if ($id == '') {
                continue;
            }
            $has_media = $media->find($id);
            $data = [
                'id' => $id,
                'name' => $file->getFileName(),
                'slug' => str_slug($file->getFileName()),
                'folder' => implode(":", $folders),
                'type' => 'image',
                'extension' => '.jpeg'
            ];
            ($has_media) ? $media->update($id, $data) : $media->store($data);
        }
    }
    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $redirect = isset($this->redirect) ? $this->redirect : $this->view;
        $media = $this->model->find($id);
        $media->description = $request->get('description');
        $media->save();
        return redirect(route("{$redirect}.type", 'image'))->with('message', 'Record was successfully updated!');
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $redirect = isset($this->redirect) ? $this->redirect : $this->view;
        $collection = $this->model->store($request->file('media'));
        if ($request->ajax()) {
            return response()->json($collection->toArray());
        }
        return redirect(route("{$redirect}.type", $collection->last()['type']))->with('message',
            'Record was successfully saved!!');
    }
    /**
     * @param $type
     * @return $this
     */
    public function getByType($type)
    {
        $records = $this->model->where('type', $type)->orderBy('id', 'desc')->paginate(settings('app-setting',
            'pagination'));
        return $this->display($this->table,
            [
                'records' => $records,
                'primary_menu' => (new MenuHelper())->getPrimaryMenu($this->package_name),
                'title' => (isset($this->title)) ? $this->title : '',
                'package' => $this->package_name,
            ]
        );
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $media = $this->model->find($id);
        \File::deleteDirectory(storage_path('uploads/' . $media->id . '/'));
        $media->delete();
        return redirect()->back();
    }
    /**
     * @param $type
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function getMediasByType($type, Request $request)
    {
        if ($type == 'image') {
            $data = $this->model->where('type', 'image')->orderBy('id', 'desc')->paginate(settings('app-setting',
                'pagination'));
        } else {
            $data = $this->model->where('type', 'image', '<>')->orderBy('id', 'desc')->paginate(settings('app-setting',
                'pagination'));
        }
        $view = view('core::admin.medias.ajax.list', compact('data'))->render();
        return response()->json(['view' => $view]);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function getModalUploadTab()
    {
        $view = view('core::admin.medias.ajax.upload')->render();
        return response()->json(['view' => $view]);
    }
}
