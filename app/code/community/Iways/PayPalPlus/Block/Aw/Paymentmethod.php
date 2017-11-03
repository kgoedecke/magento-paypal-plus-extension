<?php

class Iways_PayPalPlus_Block_Aw_Paymentmethod extends AW_Onestepcheckout_Block_Onestep_Form_Paymentmethod
{
    const PAYPAL_PLUS_TEMPLATE = 'paypalplus/aw/payment_method.phtml';

    public function getTemplate()
    {
        if(Mage::getStoreConfig('payment/iways_paypalplus_payment/active')) {
            return self::PAYPAL_PLUS_TEMPLATE;
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