<?php
namespace Robust\Core\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Robust\Core\Mail\TestEmail;
use Robust\Core\Repositories\API\SettingRepository;


/**
 * Class SettingsController
 * @package Robust\Core\Controllers\API
 */
class SettingsController extends Controller
{

    /**
     * @var AttributeRepository
     */
    protected $model;


    /**
     * SettingsController constructor.
     * @param SettingRepository $model
     */
    public function __construct(SettingRepository $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function sendTestEmail()
    {
       $data = request()->all();
       if($data['email'] != ''){
           try {
               Mail::to($data['email'])->send(
                   new TestEmail()
               );
               return 'Mail sent Successfully';
           }catch (\Exception $e){
               return 'Mail Configuration Error';
           }
       }
       return  'Please provide a email address';

    }
}
