<?php
namespace Robust\Core\Repositories;

use Robust\Core\Models\Contact;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;

/**
 * Class GroupRepository
 * @package Robust\DynamicForms\Repositories
 */
class ContactRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait ,CommonRepositoryTrait;


    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

}
