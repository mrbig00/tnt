<?php

/**
 * TNT Tests
 *
 * @author Wojciech Brozyna <http://vobro.systems>
 */

namespace thm\tnt_ec\test\unit;

require_once __DIR__ . '/../../vendor/autoload.php';

use thm\tnt_ec\service\ShippingService\ShippingService;
use thm\tnt_ec\service\ShippingService\ShippingResponse;

class ShippingResultTest extends \PHPUnit_Framework_TestCase {
    
    /**
     * @var ShippingService
     */
    protected $shipping;

    public function setUp() {

        parent::setUp();

        $this->shipping = new ShippingService('user', 'password');

        $this->shipping->setAccountNumber('A1234')
                ->setSender()->setCompanyName('Test Company')
                ->setAddressLine('Address line 1')
                ->setAddressLine('Address line 2')
                ->setAddressLine('Address line 3')
                ->setCity('City')
                ->setProvince('Province')
                ->setPostcode('Post code')
                ->setCountry('Country')
                ->setVat('123123')
                ->setContactName('Aren')
                ->setContactDialCode('Dial code')
                ->setContactPhone('Contact phone')
                ->setContactEmail('Email');

        $this->shipping->setCollection()->useSenderAddress()
                ->setShipDate('16/01/2018')
                ->setPrefCollectTime('10:00', '12:00')
                ->setAltCollectionTime('12:00', '14:00')
                ->setCollectInstruction('Collection instruction');

        $c1 = $this->shipping->addConsignment()->setConReference('GB123456789')
                ->setCustomerRef('123456789')
                ->setContype('N')
                ->setPaymentind('S')
                ->setItems(0)
                ->setTotalWeight(0.00)
                ->setTotalVolume(0.00)
                ->setCurrency('GBP')
                ->setGoodsValue(0.00)
                ->setInsuranceValue(0.00)
                ->setInsuranceCurrency('GBP')
                ->setService('15N')
                ->addOption('PR')
                ->setDescription('Description')
                ->setDeliveryInstructions('Del. instruction')
                ->hazardous(1234);

        $c1->setReceiver()->setCompanyName('Company name')
                ->setAddressLine('Address 1')
                ->setAddressLine('Address 2')
                ->setAddressLine('Address 3')
                ->setCity('City')
                ->setProvince('Province')
                ->setPostcode('12345')
                ->setCountry('GB')
                ->setVat('123456')
                ->setContactName('Name')
                ->setContactDialCode('+48')
                ->setContactPhone('123456789')
                ->setContactEmail('email@email');

        $c1->setReceiverAsDelivery();

        $c1->addPackage()->setItems(0)
                ->setDescription('')
                ->setLength(0.00)
                ->setHeight(0.00)
                ->setWidth(0.00)
                ->setWeight(0)
                ->addArticle()->setItems(0)
                ->setDescription('')
                ->setWeight(0.00)
                ->setInvoiceValue(0.00)
                ->setInvoiceDescription('Desc')
                ->setHts(0)
                ->setCountry('GB')
                ->setEmrn('EMRN');
    }
    
    public function testResponseIsObject()
    {
        
        $sr = $this->shipping->send();
        $this->assertTrue($sr instanceof ShippingResponse);
        
    }
    
}