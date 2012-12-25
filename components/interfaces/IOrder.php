<?php
/**
 * GoogleCheckout IOrder class file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */
namespace ext\tvr\googlecheckout\components\interfaces;

/**
 * IOrder class.
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @version 0.1
 * @package ext\googlecheckout\components\interfaces
 * @since 0.1
 */
interface IOrder
{
    public function getOrderId();
    public function getItems();
}