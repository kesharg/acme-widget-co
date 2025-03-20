<?php

namespace AcmeWidget;

interface OfferStrategy
{
    /**
     * @param Product[] $products
     */
    public function applyOffer(array $products): float;
}
