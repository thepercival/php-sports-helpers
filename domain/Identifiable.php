<?php
declare(strict_types=1);

namespace SportsHelpers;

interface Identifiable
{
    /**
     * @return int|string
     */
    public function getId();

    /**
     * @param int|string $id
     * @return mixed
     */
    public function setId($id);
}
