<?php
require_once dirname(__FILE__) . '/omsi/util/globalConstants.php';
require_once dirname(__FILE__) . '/omsi/helper/ProductsDbHelper.php';
require_once dirname(__FILE__) . '/omsi/loader/productsLoader.php';
require_once dirname(__FILE__) . '/omsi/services/customerService.php';

class Omsi {
    private static $instance;
    private $db;
    private $registry;
    private $log;

    /**
     * @param object $registry Registry Object
     */
    public static function get_instance($registry) {
        if (is_null(static::$instance)) {
            static::$instance = new static($registry);
        }

        return static::$instance;
    }

    public function __construct($registry) {
        $this->registry = $registry;
        $this->log = $registry->get('log');
    }

    public function updateProduct($model) {
        $productsLoader = new ProductsLoader();
        $productsLoader->loadProduct('002223');
    }

    public function createCustomerOrder() {

    }

    public function ifCustomerExists($name, $surname) {

    }

    public function testReadProductName($model) {
        try {
            $db = new \DB\mPDO('localhost', 'root', html_entity_decode('765b91475e', ENT_QUOTES, 'UTF-8'), "opencart_samopek", "3306");
            echo "Great. You are connected!!!";
            $this->log->write("Great. You are connected!!!");
            if (is_resource($db)) {
                echo "Great. You are connected!!!";
                $this->log->write("Great. You are connected!!!");
            }
            $result = $db->query("select * from oc_product limit 1");
            var_dump($result);
        } catch (Exception $e) {
            echo "Pi4al'ka. :( ";
            $this->log->write("Pi4al'ka. :( ");
        }
    }

    public function testGetCustomerByName($name) {

            $service = new customerService();
            $resultArray = $service->getCustomersByName($name);
            if (count($resultArray)) {
                echo "Great. Here is result";
                var_dump($resultArray);
            } else {
                echo "No result";
            }
    }

    public function testCreateCustomer($name, $surname, $email) {

        $service = new customerService();
        $resultArray = $service->createCustomer($name, $surname, $email);
        if (count($resultArray)) {
            echo "Great. Here is result";
            var_dump($resultArray);
        } else {
            echo "No result";
        }
    }
}