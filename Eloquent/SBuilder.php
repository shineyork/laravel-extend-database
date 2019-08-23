<?php

namespace ShineYork\LaravelExtend\Database\Eloquent;

use Illuminate\Database\Eloquent\Builder as LaravelBuilder;

class SBuilder extends LaravelBuilder
{
    public function update(array $values)
    {
        if ($this->model->fireModelEvent('updating') === false) {
            return false;
        }

        $return = $this->toBase()->update($this->addUpdatedAtColumn($values));

        $this->model->fireModelEvent('updated', false);

        return $return;
    }

    public function delete()
    {

        if ($this->model->fireModelEvent('deleting') === false) {
            return false;
        }

        if (isset($this->onDelete)) {
            return call_user_func($this->onDelete, $this);
        }

        $return = $this->toBase()->delete();

        $this->model->fireModelEvent('deleted', false);

        return $return;
    }
}
