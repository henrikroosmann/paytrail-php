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

use NordSoftware\Paytrail\Common\DataObject;
use NordSoftware\Paytrail\Exception\TooManyProducts;
use NordSoftware\Paytrail\Exception\CurrencyNotSupported;
use NordSoftware\Paytrail\Exception\LocaleNotSupported;

class SimplePayment extends DataObject
{
    const CURRENCY_EUR = 'EUR';

    const LOCALE_FIFI  = 'fi_FI';
    const LOCALE_SVSE  = 'sv_SE';
    const LOCALE_ENUS  = 'en_US';

    const VAT_MODE_INCLUDED = 1;
    const VAT_MODE_EXCLUDED = 0;

    /**
     * @var string
     */
    protected $orderNumber;

    /**
     * @var string
     */
    protected $referenceNumber = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $currency = self::CURRENCY_EUR;

    /**
     * @var string
     */
    protected $locale = self::LOCALE_FIFI;

    /**
     * @var int
     */
    protected $vatMode = self::VAT_MODE_INCLUDED;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var \NordSoftware\Paytrail\Object\UrlSet
     */
    protected $urlSet;

    /**
     * @var array
     */
    static $supportedCurrencies = array(
        self::CURRENCY_EUR,
    );

    /**
     * @var array
     */
    static $supportedLocales = array(
        self::LOCALE_FIFI,
        self::LOCALE_SVSE,
        self::LOCALE_ENUS,
    );

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
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $currency
     * @throws \NordSoftware\Paytrail\Exception\CurrencyNotSupported
     */
    public function setCurrency($currency)
    {
        if (!in_array($currency, self::$supportedCurrencies)) {
            throw new CurrencyNotSupported(sprintf('Currency "%s" is not supported.', $currency));
        }
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $locale
     * @throws @throws \NordSoftware\Paytrail\Exception\LocaleNotSupported
     */
    public function setLocale($locale)
    {
        if (!in_array($locale, self::$supportedLocales)) {
            throw new LocaleNotSupported(sprintf('Locale "%s" is not supported.', $locale));
        }
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return int
     */
    public function getVatMode()
    {
        return $this->vatMode;
    }

    /**
     * @return \NordSoftware\Paytrail\Object\UrlSet
     */
    public function getUrlSet()
    {
        return $this->urlSet;
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