<?php

namespace TestPlaceToPay\BasicPayment\Datas;

/**
 * Class DocumentTypes
 * @package TestPlaceToPay\BasicPayment\Datas
 */
abstract class DocumentTypes
{
    public static function get()
    {
        return [
            'CC' => 'Cédula de ciudanía colombiana',
            'CE' => 'Cédula de extranjería',
            'TI' => 'Tarjeta de identidad',
            'PPN' => 'Pasaporte',
            'NIT' => 'Número de identificación tributaria',
            'SSN' => 'Social Security Number'
        ];
    }
}