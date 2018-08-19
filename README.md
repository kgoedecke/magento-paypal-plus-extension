# magento-paypal-plus-extension
[![Total Downloads](https://poser.pugx.org/kgoedecke/magento-paypal-plus-extension/d/total.svg)](https://packagist.org/packages/kgoedecke/magento-paypal-plus-extension)
[![MIT License](https://poser.pugx.org/kgoedecke/magento-paypal-plus-extension/license.svg)](https://packagist.org/packages/kgoedecke/magento-paypal-plus-extension)

PayPal Plus Extension for Magento 1.x - Provided by i-ways.net

# Requirements
- Installed SSL certificate
- TLS 1.2
- PHP 5.3.7+
- Magento Version 1.7.0.1+
- Supports the following checkouts:
  - Magento Onepage 1.7.1 - 1.9
  - Amasty Checkout 2.9.10
  - Awesome Checkout 1.5.0
  - Aheadworks Checkout 1.3.8
  - Magestore Onestepcheckout 3.1.0
  - TM Firecheckout 1.3.1 / 2.7.1 / 4.0.1
  - Idev OneStepCheckout 4.1 / 4.5
  - IWD OPC 4.2.2
  
See: https://support.i-ways.net/hc/de/articles/115003454249-Voraussetzungen-PayPal-PLUS-Modul-M1

# Installation

### Composer Installation (recommended)

```
composer require https://github.com/kgoedecke/magento-paypal-plus-extension
```

### modman Installation

```
modman clone https://github.com/kgoedecke/magento-paypal-plus-extension
```

### Magento Connect Manager Installation

1. Clone repository

2. Pack the files into a tar: ```tar -cvzf magento-paypal-plus-extension.tgz app package.xml skin lib```

3. Upload the archive through Magento Connect Manager

# License
Open Software License (OSL 3.0)
