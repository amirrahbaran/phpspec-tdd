<?php

namespace RDSysCo\Ecommerce;

class Order
{
    public $gold_customer = false;
    public $silver_customer = false;
    public $items = array();
    protected $first_name;
    protected $last_name;
    protected $customer_address;
    protected $customer_city;
    protected $customer_country;
    protected $shipping_address;

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
        return $this->gold_customer;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $currency = '';
            // we check for the item to be valid
            if (isset($item['price']) && isset($item['quantity'])) {
                // we detect currency if indicated
                $price = explode(' ', $item['price']);
                if (isset($price[1])) {
                    $currency = $price[1];
                }
                $price = $price[0];
                $total += $price * $item['quantity'];
            }
        }
        // If the customer is gold we apply 40% discount and...
        if ($this->gold_customer) {
            $total = $total * 0.6;
            // ...if amount is over 500 we apply further 20% discount
            if ($total > 500) {
                $total = $total * 0.8;
            }
        } // If the customer is silver we apply 20% discount and...
        elseif ($this->silver_customer) {
            $total = $total * 0.8;
            // ...if amount is over 500 we apply further 10% discount
            if ($total > 500) {
                $total = $total * 0.9;
            }
        } else {
            // if customer subscribed no fidelity program we apply 10% over 500
            if ($total > 500) {
                $total = $total * 0.9;
            }
        }
        if ($currency) {
            return round($total, 2) . ' ' . $currency;
        } else return round($total, 2);
    }
}
