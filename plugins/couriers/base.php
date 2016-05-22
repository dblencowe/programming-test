<?php

namespace \Docnet\Plugins\Shipping;

class Base extends \Docnet\Plugins\Base
{
    public $manifests = null;

    /**
     * Run any start of day functions
     */
    public function startBatch()
    {

    }

    /**
     * Clear any manifests for the day
     */
    public function endBatch()
    {
        // Push consignments to third party and
        $this->pushConsignments();
        $this->manifests = null;
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
     * Push consignments to external solution
     *
     * @return void
     */
    private function pushConsignments()
    {
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