<?php
class Basket 
{
    private $id_basket;
    private $id_user;
    private $error_message = 'Корзина пуста';
 
    public function __construct($id_basket, $id_user)
    {   
        session_start();
        $this -> id_basket = $id_basket;
        $this -> id_user = $id_user;
    }

    public function addGoods($goods = null)
    {
        foreach($goods as $key => $val){
            if($key === 'id_goods')
            {
                $_SESSION['storage_goods'][$val] = $goods;
            }
        }
    }

    public function removeGoods($id_goods)
    {
        foreach($_SESSION['storage_goods'] as $key => $goods)
        {
            if($goods['id_goods'] === $id_goods)
            {   
                unset($_SESSION['storage_goods'][$key]);
            }
        }
    }

    public function viewGoods()
    {
        if(isset($_SESSION['storage_goods']) && !empty($_SESSION['storage_goods'])){
            return $_SESSION['storage_goods'];
        } else {
            return $this -> error_message;
        }

    }

    public function clearBasket()
    {
        unset($_SESSION['storage_goods']);
    }
}

class Small_Basket
{
    
}

$arGoods = 
[
    ['id_goods' => 1111, 'name' => 'Лампа', 'price' => 1000, 'currencies' => 'руб', 'count' => 1 ],
    ['id_goods' => 1112, 'name' => 'Носки', 'price' => 200, 'currencies' => 'руб', 'count' => 1 ],
];

$basket = new Basket(111111, 111112);
// $basket -> addGoods($arGoods[0]);
$basket -> removeGoods(1112);
// $basket -> clearBasket();
print_r($basket -> viewGoods());
