<?php
/**
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com and you will be sent a copy immediately.
 *
 * Created on 02.03.2015
 * Author Robert Hillebrand - hillebrand@i-ways.de - i-ways sales solutions GmbH
 * Copyright i-ways sales solutions GmbH © 2015. All Rights Reserved.
 * License http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 *
 */

/**
 * Iways PayPalPlus Onepage Payment Methods Block
 *
 * @category   Iways
 * @package    Iways_PayPalPlus
 * @author robert
 */
class Iways_PayPalPlus_Block_Onepage_Payment_Methods extends Mage_Checkout_Block_Onepage_Payment_Methods
{
    /**
     * Default PayPal Plus method template
     */
    const DEFAULT_TEMPLATE = 'paypalplus/methods.phtml';
    /**
     * Magestore PayPal Plus method template
     */
    const MAGESTORE_TEMPLATE = 'paypalplus/magestore/onestepcheckout/payment_method.phtml';

    /**
     * Awesome PayPal Plus method template
     */
    const AWESOME_TEMPLATE = 'paypalplus/awesome/payment/methods.phtml';

    /**
     * Idev PayPal Plus method template
     */
    const IDEV_TEMPLATE = 'paypalplus/onestepcheckout/payment_method.phtml';

    /**
     * Firecheckout PayPal Plus method template
     */
    const FIRECHECKOUT_TEMPLATE = 'paypalplus/firecheckout/checkout/payment/methods.phtml';


    /**
     * Override template file for different checkouts
     * @return string
     */
    public function getTemplate()
    {
        if (Mage::getStoreConfig('payment/iways_paypalplus_payment/active')) {
            if (Mage::helper('iways_paypalplus')->isFirecheckout()) {
                return self::FIRECHECKOUT_TEMPLATE;
            }
            if (Mage::helper('iways_paypalplus')->isMagestoreOsc()) {
                return self::MAGESTORE_TEMPLATE;
            }
            if (Mage::helper('iways_paypalplus')->isIwdOsc()) {
                return self::DEFAULT_TEMPLATE;
            }
            if (Mage::helper('iways_paypalplus')->isAwesomeCheckout()) {
                return self::AWESOME_TEMPLATE;
            }
            if (Mage::helper('iways_paypalplus')->isIdevOsc()) {
                return self::IDEV_TEMPLATE;
            }
        }
        return parent::getTemplate();
    }


    /**
     * Builds third party methods array
     *
     * @return array
     */
    public function getThirdPartyMethods()
    {
        $thirdPartyMethods = Mage::getStoreConfig('payment/iways_paypalplus_payment/third_party_moduls');

        if (!empty($thirdPartyMethods)) {
            $thirdPartyMethods = explode(',', $thirdPartyMethods);
        } else {
            $thirdPartyMethods = array();
        }
        $thirdPartyMethods = array_merge(
            $thirdPartyMethods,
            array(
                'paypaluk_direct',
                'paypaluk_express',
                'paypal_standard',
                'paypal_direct',
                'paypal_express_bml',
                'paypal_express'
            )
        );
        $thirdPartyPayPalMethods = array();
        foreach ($thirdPartyMethods as $thirdPartyMethod) {
            $thirdPartyPayPalMethods[$thirdPartyMethod] = true;
        }
        return $thirdPartyPayPalMethods;
    }


    /**
     * Checks if iways_paypalplus_payment is active and a payment experience could be retrieved from PayPal
     *
     * @return bool
     */
    public function isPPPActive()
    {
        $paymentExperience = Mage::helper('iways_paypalplus')->getPaymentExperience();

        if ($paymentExperience) {
            foreach ($this->getMethods() as $_method) {
                if ($_method->getCode() == Iways_PayPalPlus_Model_Payment::METHOD_CODE) {
                    return true;
                }
            }
        }
        return false;
    }
}