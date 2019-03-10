<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\PolyMorphRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Activity;
use Robust\Projects\Models\Goal;
use Robust\Projects\Models\Assumption;
use Robust\Projects\Models\Outcome;
use Robust\Projects\Models\Output;

/**
 * Class IndicatorRepository
 * @package Robust\Projects\Repositories
 */
class AssumptionRepository
{
    use PolyMorphRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;
    /**
     * @var array
     */
    protected $morphed = [
        'activities' => 'assumptions',
        'goals' => 'assumptions',
        'outcomes' => 'assumptions',
        'outputs' => 'assumptions'
    ];

    protected $poly_morph = [
        'assumptions' => ['id' => 'assumable_id', 'type' => 'assumable_type']
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
    public function __construct(Assumption $model)
    {
        $this->model = $model;
    }
}
