<?php

namespace RDSysCo\Ecommerce;

class Order
{
    public $currency = '';
    private $gold_customer = false;
    private $silver_customer = false;
    public $items = array();
    protected $first_name;
    protected $last_name;
    protected $customer_address;
    protected $customer_city;
    protected $customer_country;
    protected $shipping_address;
    private $total = 0;

    const discount_threshold = 500;

    public function setItem($code, $price, $description, $quantity)
    {
        $this->items[] = array('code' => $code,
            'price' => $price,
            'description' => $description,
            'quantity' => $quantity
        );
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function listItems()
    {
        return $this->items;
    }

    public function setCustomer($customer)
    {
        list($this->first_name, $this->last_name) = explode(' ', $customer);
    }

    public function getCustomer()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setShippingAddress($address)
    {
        $this->shipping_address = $address;
    }

    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    public function isGoldCustomer()
    {
        return $this->gold_customer === true;
    }

    public function getGoldCustomer()
    {
        return $this->gold_customer;
    }

    public function setGoldCustomer()
    {
        $this->gold_customer = true;
    }

    public function unsetGoldCustomer()
    {
        $this->gold_customer = false;
    }

    public function isSilverCustomer()
    {
        return $this->silver_customer === true;
    }

    public function getSilverCustomer()
    {
        return $this->silver_customer;
    }

    public function setSilverCustomer()
    {
        $this->silver_customer = true;
    }

    public function unsetSilverCustomer()
    {
        $this->silver_customer = false;
    }

    public function getTotal()
    {
        $this->total = $this->getOrderPrice();
        $this->total = $this->getOrderDiscount();
        return $this->getOrderPriceWithCurrency();
    }

    /**
     * @return mixed
     * @internal param $total
     */
    public function getOrderDiscount()
    {
        if ($this->isGoldCustomer()) {
            $orderDiscount = $this->getDiscount(0.6, 0.8);
        } elseif ($this->isSilverCustomer()) {
            $orderDiscount = $this->getDiscount(0.8, 0.9);
        } else {
            $orderDiscount = $this->getDiscount(0, 0.9);
        }
        return $orderDiscount;
    }

    /**
     * @return array
     */
    public function getOrderPrice()
    {
        $orderPrice = 0;
        foreach ($this->items as $item) {
            $item_is_valid = isset($item['price']) && isset($item['quantity']);
            if ($item_is_valid) {
                $orderPrice = $this->detectCurrencyIfIndicated($item);
            }
        }
        return $orderPrice;
    }

    /**
     * @return float|string
     * @internal param $total
     * @internal param $currency
     */
    public function getOrderPriceWithCurrency()
    {
        $priceWithCurrency = round($this->total, 2);
        if ($this->currency) {
            $priceWithCurrency .= ' ' . $this->currency;
        }
        return $priceWithCurrency;
    }

    /**
     * @param $item
     * @return mixed
     * @internal param $total
     */
    public function detectCurrencyIfIndicated($item)
    {
        $orderTotal = 0;
        $price = explode(' ', $item['price']);
        if (isset($price[1])) {
            $this->currency = $price[1];
        }
        $price = $price[0];
        $orderTotal += $price * $item['quantity'];
        return $orderTotal;
    }

    /**
     * @param int $discount
     * @param $discountIfOrderAmountIsOverThreshold
     * @return mixed
     * @internal param $total
     */
    public function getDiscount($discount = 0, $discountIfOrderAmountIsOverThreshold = 0)
    {
        $orderDiscount = $this->total;
        if ($discount !== 0) {
            $orderDiscount *= $discount;
        }

        if ($discountIfOrderAmountIsOverThreshold !== 0 && $orderDiscount > self::discount_threshold) {
            $orderDiscount = $orderDiscount * $discountIfOrderAmountIsOverThreshold;
        }
        return $orderDiscount;
    }
}
