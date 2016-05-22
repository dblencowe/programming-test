<?php

namespace Docnet\Plugins\Shipping;

use Docnet\Plugins\Base;

class RoyalMail extends Base
{
    /**
     * Royal mail customer identification credentials
     *
     * @var int
     */
    private $customerNumber = 401;

    /**
     * Array of consignment numbers for that day
     * @var array [consignmentNo => time()]
     */
    public $manifest = [];

    /**
     * Directory to store processed manifests in
     * @var null
     */
    protected $manifestDoneDir = null;

    /**
     * Directory to store pending mansifests in
     * @var null
     */
    protected $manifestPendingDir = null;

    /**
     * Set directory for storing manifests
     */
    public function init()
    {
        $this->manifestDoneDir = '/cache/plugins/shipping/royalmail/done/';
        $this->manifestPendingDir = '/cache/plugins/shipping/royalmail/pending/';
    }

    /**
     * @inheritdoc
     */
    public function exportConsignment($package, $customer)
    {
        // Should be called as a queue job on end of day

        if (empty($this->manifest)) {
            return true; // Nothing to process, exit
        }

        $todaysManifest = [];
        // Perform some sanitisation
        foreach ($this->manifest as $consignmentNo => $time) {
            if ($time < strtotime('-1 day')) {
                continue;
            }

            $todaysManifest[] = [
                $consignmentNo,
                $this->customerNumber,
                $package->address()->title,
                $package->address()->firstName,
                $package->address()->lastName,
                $package->address()->address1,
                $package->address()->address2,
                $package->address()->address3,
                $package->address()->town,
                $package->address()->county,
                $package->address()->postcode,
            ];
        }

        // Turn in to a csv. Nice and crudely does it
        foreach ($todaysManifest as &$row) {
            $row = implode(',', $row);
        }

        file_put_contents($this->manifestPendingDir . date('c') . '.csv', implode('\n', $todaysManifest));

        return $this->sendConsignmentFiles();
    }

    private function sendConsignmentFiles()
    {
        $files = Utility::readDir($this->manifestPendingDir);

        if (empty($files)) {
            throw new \Exception('sendConsignmentFiles called but no pending manifests found');
        }

        $connection = $this->app->ftp()->create($this->pluginSettings['outbound_ftp']);
        foreach ($files as $file) {
            $rst = $connection->upload($file);
            if (!empty($rst)) {
                throw new Exception("Error uploading $file to royalmail: " . json_encode($rst));
            }
        }

        return true;
    }

}