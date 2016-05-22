<?php

namespace \Docnet\Plugins\Shipping;

class Base extends \Docnet\Plugins\Base
{
    public $features = [
        'labelFormat' => 'png',
        'transportMethod' => false,
    ];

    /**
     * Export consigments for the external shipping solution
     *
     * @param array $order    Order details
     * @param array $package  Package details
     * @param array $customer Customer details
     *
     * @return array Tracking info (if any)
     */
    public function exportConsignment($package, $customer)
    {
        return [];
    }

    /**
     * Push consignments to external solution
     *
     * @return void
     */
    public function pushConsignments()
    {
    }

    /**
     * Add package to current manifest
     *
     * @param array $order    Order details
     * @param array $package  Package details
     * @param array $customer Customer details
     *
     * @throws \Exception
     *
     * @return void
     */
    public function addToManifest($order, $package, $customer)
    {
    }

    /**
     * Complete current manifest(s)
     *
     * @return array Array of manifested consignment ids keyed by manifest id
     */
    public function completeManifests()
    {
        return [];
    }

    /**
     * Get a label for a given consignment
     *
     * @param array  $order      Details of parent order to which the label package belongs
     * @param array  $package    Details of package for which to fetch label
     * @param string $designType Label design type (standard|mini)
     *
     * @return string Label data (in the format specified in the plugin features)
     */
    public function getLabel($order, $package, $designType = 'standard')
    {
        // @todo Produce a standard label for XYZ Ltd
    }
}