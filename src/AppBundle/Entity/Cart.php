<?php

namespace AppBundle\Entity;

use \ArrayObject;

class Cart extends ArrayObject
{
    public function __constructor()
    {
        $this->setFlags(ArrayObject::ARRAY_AS_PROPS);
    }

    public function add(Product $product)
    {
        if ($this->offsetExists($product->getId())) {
            $cartItem = $this->offsetGet($product->getId());
            $newQuantity = $cartItem->quantity + 1;
            $this->update($product->getId(), $newQuantity);
        } else {
            $cartItem = new ArrayObject();
            $cartItem->setFlags(ArrayObject::ARRAY_AS_PROPS);
            $cartItem->offsetSet('product', $product);
            $cartItem->offsetSet('quantity', 1);
            $this->offsetSet($product->getId(), $cartItem);
        }
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        if (is_int($id)) {
            $this->offsetUnset($id);
        }
    }

    /**
     * @param int $id
     */
    public function update($id, $quantity)
    {
        if (is_int($id)) {
            $isValidQuantity = round($quantity) && ($quantity > 0 && $quantity <= 10);
            if ($isValidQuantity && $this->offsetExists($id)) {
                $cartItem = $this->offsetGet($id);
                $cartItem->quantity = $quantity;
            }
        }
    }

    public function getQuantity()
    {
        $quantity = 0;
        foreach ($this as $cartItem) {
            $quantity += $cartItem->quantity;
        }
        return $quantity;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this as $cartItem) {
            $total += $cartItem->product->getPrice() * $cartItem->quantity;
        }
        return $total;
    }
}
