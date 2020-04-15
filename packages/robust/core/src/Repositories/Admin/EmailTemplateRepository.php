<?php
namespace Robust\Core\Repositories\Admin;

use Robust\Core\Models\EmailTemplate;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;


/**
 * Class EmailTemplateRepository
 * @package Robust\Core\Repositories\Admin
 */
class EmailTemplateRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * @var EmailTemplate
     */
    protected $model;

    /**
     * EmailTemplateRepository constructor.
     * @param EmailTemplate $model
     */
    public function __construct(EmailTemplate $model)
    {
        $this->model = $model;
    }
}
