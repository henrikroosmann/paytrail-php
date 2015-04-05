<?php
/*
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NordSoftware\Paytrail\Object;

class SimplePayment extends Payment
{
    /**
     * @var float
     */
    protected $price;

    /**
     * @return array
     */
    public function toArray()
    {
        $array = array();
        $array['orderNumber'] = $this->orderNumber;
        if (isset($this->referenceNumber)) {
            $array['referenceNumber'] = $this->referenceNumber;
        }
        if (isset($this->description)) {
            $array['description'] = $this->description;
        }
        $array['currency'] = $this->currency;
        if (isset($this->locale)) {
            $array['locale'] = $this->locale;
        }

        if (isset($this->price)) {
            $array['price'] = $this->price;
        }

        if ($this->urlSet !== null) {
            $array['urlSet'] = $this->urlSet->toArray();
        }
        return $array;
    }

    /**
     * @param float $price
     * @throws @throws \NordSoftware\Paytrail\Exception\PriceNotSupported
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}