<?php
/**
 * GoogleCheckout IProduct class file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */
namespace ext\googlecheckout\components\interfaces;

/**
 * IProduct class.
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @version 0.1
 * @package ext\googlecheckout\components\interfaces
 * @since 0.1
 */
interface IProduct
{
    public function getId();
    public function getTitle();
    public function getDescription();
    public function getPrice();
    public function getQuantity();
}