<?php


namespace App\Model;


class IndividualManager extends AbstractManager
{

    private const TABLE = 'dogs';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
