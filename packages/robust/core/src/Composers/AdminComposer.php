<?php namespace Robust\Core\Composers;

use Illuminate\Contracts\View\View;
use Robust\Core\Helpers\BannerHelper;
use Robust\Core\Helpers\AdvanceSearchHelper;
use Robust\Core\Helpers\SettingsHelper;

/**
 * Class AdminComposer
 * @package App\Http\ViewComposers
 */
class AdminComposer
{
    /**
     * AdminComposer constructor.
     * @param BannerHelper $banner_helper
     * @param SettingsHelper $setting_helper
     * @param AdvanceSearchHelper $advancesearch_helper
     */
    public function __construct(
        BannerHelper $banner_helper,
        SettingsHelper $setting_helper,
        AdvanceSearchHelper $advancesearch_helper
    )
    {
        $this->banner_helper = $banner_helper;
        $this->setting_helper = $setting_helper;
        $this->advancesearch_helper = $advancesearch_helper;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('banner_helper', $this->banner_helper);
        $view->with('setting_helper', $this->setting_helper);
        $view->with('advancesearch_helper', $this->advancesearch_helper);
    }
}
