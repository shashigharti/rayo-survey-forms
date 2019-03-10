<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\PolyMorphRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Activity;
use Robust\Projects\Models\Goal;
use Robust\Projects\Models\Indicator;
use Robust\Projects\Models\Outcome;
use Robust\Projects\Models\Output;

/**
 * Class IndicatorRepository
 * @package Robust\Projects\Repositories
 */
class IndicatorRepository
{
    use PolyMorphRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;
    /**
     * @var array
     */
    protected $morphed = [
        'activities' => 'indicators',
        'goals' => 'indicators',
        'outcomes' => 'indicators',
        'outputs' => 'indicators'
    ];

    protected $poly_morph = [
        'indicators' => ['id' => 'indicatable_id', 'type' => 'indicatable_type']
    ];

    /**
     * @var arrayc
     */
    protected $morphable = [
        'activities' => Activity::class,
        'goals' => Goal::class,
        'outcomes' => Outcome::class,
        'outputs' => Output::class
    ];

    /**
     * IndicatorRepository constructor.
     * @param Indicator $model
     */
    public function __construct(Indicator $model)
    {
        $this->model = $model;
    }
}
