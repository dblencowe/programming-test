<?php

class Address
{
    /**
     * Full delivery address where each part is an array element
     *
     * @var array
     */
    public $deliveryAddress = [];

    /**
     * Full billing address where each part is an array element
     *
     * @var
     */
    public $billingAddress = [];

    /**
     * Get customers address
     *
     * @param string $type delivery|billing address
     * @param string $format raw|string Return address as a string (for labels) or as an array
     * @return array|string
     */
    public function getAddressAttribute($type = 'delivery', $format = 'raw')
    {
        $address = $this->deliveryAddress;
        if ($type == 'billing') {
            $address = $this->billingAddress;
        }

        switch ($format) {
            case 'string':
                return implode('\n', $address);
            case 'raw':
            default:
                return $address;
        }
    }

    /**
     * Define relationship between customer - address
     * @return mixed
     */
    public function customer()
    {
        return $this->belongsTo('Customer');
    }
}