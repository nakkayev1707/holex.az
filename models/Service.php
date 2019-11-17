<?php


namespace app\models;


class Service
{
    private $serviceTable = 'services';
    private $serviceTypeTable = 'services_types';

    /**
     * @param $amount - set 0 for getting all
     * @return array of service types
     */
    public function getServiceTypes($amount){
        $types = [];
        return $types;
    }

}