<?php

class Customer
{
    /**
     * Customer name
     *
     * @var array
     */
    public $name = [
        'title' => 'Mr',
        'firstName' => 'John',
        'Doe',
    ];

    /**
     * Define relationship between customer - address
     * @return mixed
     */
    public function address()
    {
        return $this->hasOne('Address');
    }

    /**
     * Define relationship between customer < orders
     * @return mixed
     */
    public function orders()
    {
        return $this->hasMany('Order');
    }
}