<?php

namespace spec\RDSysCo\Ecommerce;

use RDSysCo\Ecommerce\Order;
use PhpSpec\ObjectBehavior;

class OrderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Order::class);
    }

//    function it_should_return_true_for_gold_customer()
//    {
//
//    }

    function it_should_return_total_6_for_2_items_with_3_amount_with_total_less_than_500_with_dollar_currency()
    {
        $this->currency = '$';
        $this->setItem(001, 3, 'TestItem1', 2);
        $this->getTotal()->shouldEqual('6 $');
    }

    function it_should_return_total_6_for_2_items_with_3_amount_with_total_less_than_500()
    {
        $this->setItem(001, 3, 'TestItem1', 2);
        $this->getTotal()->shouldReturn(6.0);
    }

    function it_should_return_total_3DOT6_for_2_items_with_3_amount_for_golden_discount_with_total_less_than_500()
    {
        $this->setGoldCustomer();
        $this->setItem(001, 3, 'TestItem1', 2);
        $this->getTotal()->shouldReturn(3.6);
    }

    function it_should_return_total_4DOT8_for_2_items_with_3_amount_for_silver_discount_with_total_less_than_500()
    {
        $this->setSilverCustomer();
        $this->setItem(001, 3, 'TestItem1', 2);
        $this->getTotal()->shouldReturn(4.8);
    }

    function it_should_return_total_630_for_4_items_with_175_amount()
    {
        $this->setItem(001, 175, 'TestItem1', 4);
        $this->getTotal()->shouldReturn(630.0);
    }

    function it_should_return_total_420_for_4_items_with_175_amount_for_golden_discount()
    {
        $this->setGoldCustomer();
        $this->setItem(001, 175, 'TestItem1', 4);
        $this->getTotal()->shouldReturn(420.0);
    }

    function it_should_return_total_480_for_4_items_with_250_amount_for_golden_discount_with_total_greater_than_500()
    {
        $this->setGoldCustomer();
        $this->setItem(001, 250, 'TestItem1', 4);
        $this->getTotal()->shouldReturn(480.0);
    }

    function it_should_return_total_720_for_4_items_with_250_amount_for_silver_discount_with_total_greater_than_500()
    {
        $this->setSilverCustomer();
        $this->setItem(001, 250, 'TestItem1', 4);
        $this->getTotal()->shouldReturn(720.0);
    }

    function it_should_return_total_504_for_4_items_with_175amount_for_silver_discount()
    {
        $this->setSilverCustomer();
        $this->setItem(001, 175, 'TestItem1', 4);
        $this->getTotal()->shouldReturn(504.0);
    }

    function it_should_return_list_of_items()
    {
        $this->setItem(001, 101, 'TestItem1', 14);
        $this->setItem(002, 175, 'TestItem1', 41);
        $this->setItem(003, 210, 'TestItem1', 22);
        $this->setItem(004, 40, 'TestItem1', 17);
        $this->listItems()->shouldBeArray();
    }

}
