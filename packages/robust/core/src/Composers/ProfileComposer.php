<?php namespace Robust\Core\Composers;

use Illuminate\Contracts\View\View;
use Robust\Core\Repositories\Admin\UserRepository;

/**
 * Class ProfileComposer
 * @package App\Http\ViewComposers
 */
class ProfileComposer {

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ProfileComposer constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = $this->user->find(\Auth::user()->id);

        $view->with('user', $user);
        $view->with('notifications', $user->unreadNotifications()->take(5)->get());

        if(!isset($view->dashboard)){
            $view->with('dashboard', $user->dashboards->where('is_default', true)->first());
        }

    }

}
