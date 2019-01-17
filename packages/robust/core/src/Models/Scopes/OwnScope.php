<?php

namespace Robust\Core\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use function PhpParser\canonicalize;

/**
 * Class OwnScope
 * @package Robust\Core\Scopes
 */
class OwnScope implements Scope
{

    /**
     * @param Builder $builder
     * @param Model $model
     * @return $this
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = \Auth::user();
        if ($user->can('core.data.all')) {
            return;
        }
        
        if ($user->can('core.data.own')) {

            if (method_exists($model, 'filter')) {
                return $builder = $model->filter($builder);
            }

            return $builder->where('user_id', $user->id);
        }


    }
}