<?php

namespace Arrilot\BitrixTankers;

use Arrilot\Tankers\Tanker;

abstract class BitrixTanker extends Tanker
{
    /**
     * Field suffix.
     *
     * @var string
     */
    protected $suffix = '_DATA';

    /**
     * Fields that should be selected.
     *
     * @var mixed
     */
    protected $select = [];

    /**
     * Setter for select.
     *
     * @param array $select
     * @return $this
     */
    public function select($select)
    {
        if (!in_array('ID', $select)) {
            array_unshift($select, 'ID');
        }

        $this->select = $select;

        return $this;
    }

    /**
     * Build filter.
     *
     * @param array $ids
     * @return array
     */
    protected function buildFilter(array $ids)
    {
        $filter = count($ids) > 1 ? ['=ID' => $ids] : ['=ID' => $ids[0]];

        if (!empty($this->where) && is_array($this->where)) {
            $filter = array_merge($filter, $this->where);
        }

        return $filter;
    }
}
