<?php

namespace RDSysCo\Ecommerce;

class Order
{
    public $currency = '';
    public $gold_customer = false;
    public $silver_customer = false;
    public $items = array();
    protected $first_name;
    protected $last_name;
    protected $customer_address;
    protected $customer_city;
    protected $customer_country;
    protected $shipping_address;
    private $total = 0;

    public function setItem($code, $price, $description, $quantity)
    {
//        $item = new Item();
//        $item->setCode($code);
//        $item->setPrice($price);
//        $item->setDescription($description);
//        $item->setQuantity($quantity);

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
        return $this->gold_customer;
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
        if ($this->gold_customer) {
            $orderDiscount = $this->getGoldenDiscount();
        }
        elseif ($this->silver_customer) {
            $orderDiscount = $this->getSilverDiscount();
        } else {
            $orderDiscount = $this->getOrdinaryDiscount();
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
     * @return mixed
     * @internal param $total
     */
    public function getGoldenDiscount()
    {
        // If the customer is gold we apply 40% discount and...
        $orderDiscount = $this->total * 0.6;
        // ...if amount is over 500 we apply further 20% discount
        if ($orderDiscount > 500) {
            $orderDiscount = $orderDiscount * 0.8;
        }
        return $orderDiscount;
    }

    /**
     * @return mixed
     * @internal param $total
     */
    public function getSilverDiscount()
    {
        // If the customer is silver we apply 20% discount and...
        $orderDiscount = $this->total * 0.8;
        // ...if amount is over 500 we apply further 10% discount
        if ($orderDiscount > 500) {
            $orderDiscount = $orderDiscount * 0.9;
        }
        return $orderDiscount;
    }

    /**
     * @return mixed
     * @internal param $total
     */
    public function getOrdinaryDiscount()
    {
        $orderDiscount = $this->total;
        // if customer subscribed no fidelity program we apply 10% over 500
        if ($orderDiscount > 500) {
            $orderDiscount = $orderDiscount * 0.9;
        }
        return $orderDiscount;
    }
}
