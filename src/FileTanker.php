<?php

namespace Arrilot\BitrixTankers;

use Bitrix\Main\FileTable;

class FileTanker extends BitrixTanker
{
    /**
     * Fetch data for given ids.
     *
     * @param array $ids
     * @return array
     */
    protected function fetch(array $ids)
    {
        $files = [];
        $result = FileTable::getList([
            'filter' => ['ID' => $ids],
            'select' => $this->prepareSelect(),
        ]);
        while ($row = $result->fetch()) {
            $files[$row['ID']] = $row;
        }

        return $files;
    }
}
