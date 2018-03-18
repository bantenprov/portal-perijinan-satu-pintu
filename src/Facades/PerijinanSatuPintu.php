<?php

namespace Bantenprov\PerijinanSatuPintu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The PerijinanSatuPintu facade.
 *
 * @package Bantenprov\PerijinanSatuPintu
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class PerijinanSatuPintuFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'perijinan-satu-pintu';
    }
}
