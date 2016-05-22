<?php

class Order
{
    /**
     * Checkout completion date
     * @var
     */
    public $checkoutCompletionDate;

    /**
     * Dispatch date, null == not dispatched yet (processing)
     * @var null
     */
    public $dispatchDate = null;

    /**
     * Mark order as dispatched (To be called during PPD after manifest sent)
     */
    public function markDispatched()
    {
        $this->dispatchDate = time();
    }
}