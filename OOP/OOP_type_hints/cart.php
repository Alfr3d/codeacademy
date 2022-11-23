<?php

declare(strict_types=1);

// https://github.com/CodeAcademyPHP/OOP/blob/master/lesson2/1_cart.php

class Cart
{
    private array $cartItems = [];
    private array $cartDiscounts = [];

    public function __construct(private Customer $customer)
    {
    }

    public function addItem(CartItem $cartItem): void
    {
        $this->cartItems[] = $cartItem;
    }

    public function addDiscount(CartDiscount $discount): void
    {
        $this->cartDiscounts[] = $discount;
    }

    public function getTotal(): float
    {
        $totalCartPrice = 0;
        $customerLevel = $this->customer->getLevel();

        /** @var CartItem $cartItem */
        foreach ($this->cartItems as $cartItem) {
            $totalCartPrice += $cartItem->getPrice();
        }

        /** @var CartDiscount $cartDiscount */
        foreach ($this->cartDiscounts as $cartDiscount) {
            if ($cartDiscount->getCustomerLevel() === $customerLevel) {
                $totalCartPrice -= $totalCartPrice * $cartDiscount->getDiscountPercent() / 100;
            }
        }

        return round($totalCartPrice, 2);
    }
}

class CartItem
{
    public function __construct(private string $name, private int $price)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}

class CartDiscount
{
    public function __construct(private int $percent, private string $userLevel)
    {
    }

    public function getDiscountPercent(): int
    {
        return $this->percent;
    }

    public function getCustomerLevel(): string
    {
        return $this->userLevel;
    }
}

class Customer
{
    public function __construct(
        private string $name,
        private string $surname,
        private string $level
    ) {
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getLevel(): string
    {
        return $this->level;
    }
}

$customer = new Customer('John', 'Smith', 'A');
$cart = new Cart($customer);
$iphone = new CartItem('Iphone 13', 1300);
$airpods = new CartItem('Airpods Pro', 200);
$cart->addItem($iphone);
$cart->addItem($airpods);
//$cart->getTotal();
$cartDiscount1 = new CartDiscount(15, 'A');
$cart->addDiscount($cartDiscount1);
$cartDiscount2 = new CartDiscount(2, 'A');
$cart->addDiscount($cartDiscount2);
$cartDiscount3 = new CartDiscount(20, 'B');
$cart->addDiscount($cartDiscount3);
$total = $cart->getTotal();
var_dump($total); // 1249.5
