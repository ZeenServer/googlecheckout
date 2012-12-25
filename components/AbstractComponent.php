<?php
/**
 * GoogleCheckout AbstractComponent class file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */

namespace ext\tvr\googlecheckout\components;
use \Yii;

/**
 * AbstractComponent class
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @version 0.1
 * @package ext\googlecheckout\components
 * @since 0.1
 */
abstract class AbstractComponent extends \CComponent
{
    /**
     * Init method
     * @return boolean
     */
    public function init()
    {
        return true;
    }
}