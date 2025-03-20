<?php

namespace AcmeWidget;

interface DeliveryStrategy
{
    public function calculate(float $total): float;
}
