<?php

namespace App;
use Illuminate\Support\Facades\Cache;

class Basket {
  public static function getItemCount(int $user_id, int $item_id) : int {
      $basket = self::getBasket($user_id);
      if (!array_key_exists($item_id, $basket)) return 0;
      return $basket[$item_id];
  }

  public static function getItemIds(int $user_id) : array {
      return self::getBasket($user_id);
  }

  public static function clear(int $user_id) {
    Cache::delete(self::getBasketKey($user_id));
  }

  public static function deleteItemId(int $user_id, int $item_id) {
    $basket = self::getBasket($user_id);
    unset($basket[$item_id]);
    self::setBasket($user_id, $basket);
  }

  private static function getBasketKey(int $user_id) : string {
      return "user:{$user_id}:basket";
  }

  private static function getBasket(int $user_id) : array {
      $basket = Cache::get(self::getBasketKey($user_id));
      return $basket ?? [];
  }

  private static function setBasket(int $user_id, array $basket) : void {
      Cache::set(self::getBasketKey($user_id), $basket);
  }

  public static function updateItemCount(int $user_id, int $item_id, int $count) : void {
      $basket = self::getBasket($user_id);
      if ($count <= 0){
        unset($basket[$item_id]);
      } else {
        $basket[$item_id] = $count;
      }

      self::setBasket($user_id, $basket);
  }
}
