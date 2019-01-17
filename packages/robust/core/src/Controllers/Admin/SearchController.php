<?php
namespace Robust\Core\Controllers\Admin;

use Illuminate\Http\Request;
use Robust\Core\Helpers\MenuHelper;
use Robust\Core\Repositories\SearchRepository;

/**
 * Class SearchController
 * @package Robust\Core\Controllers\Admin
 */
class SearchController extends Controller
{

    /**
     * SearchController constructor.
     * @param SearchRepository $search
     */
    public function __construct(SearchRepository $search)
    {
        $this->search = $search;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $data = $request->all();
        $search_data = $this->search->search($data);
        $package_name = $this->search->getPackageName($data['model']);
        $ui = $this->search->getUI($data['model']);
        return view('core::admin.partials.tables.table',
            [
                'records' => $search_data,
                'primary_menu' => (new MenuHelper())->getPrimaryMenu($package_name),
                'title' => (isset($this->title)) ? $this->title : '',
                'package' => $package_name,
                'ui' => $ui,
                'keyword' => $data['keyword']
            ]
        );
    }
}
