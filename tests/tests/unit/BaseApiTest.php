<?php

namespace wishlist\classes;

require_once realpath(dirname(__FILE__) . '/../..') . '/enviroment.php';

doLogin();

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-06-28 at 11:26:12.
 */
class BaseApiTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var BaseApi
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new BaseApi;

        $_POST = array(
            'wishlist' => 1,
            'wishListName' => "list",
            'listItem' => array(5, 6),
            'user_id' => $GLOBALS['userId']
        );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function test_deinstall() {
        $this->object->_deinstall();
    }

    public function test_install() {
        $this->object->_install();
    }

    /**
     * @covers wishlist\classes\BaseApi::_addItem
     * @todo   Implement test_addItem().
     * @dataProvider _addItem_provider
     */
    public function test_addItem($var_id) {
        $result = $this->object->_addItem($var_id);
        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertRegExp('/Добавлено/', $result);
    }

    public function _addItem_provider() {
        return array(
            array(1),
            array(2),
            array(3)
        );
    }

    /**
     * @covers wishlist\classes\BaseApi::moveItem
     * @todo   Implement testMoveItem().
     * @dataProvider moveItem_provider
     */
    public function testMoveItem($var_id, $wish_list_id) {
        $_POST = array(
            'wishlist' => 1 + $var_id,
            'wishListName' => "list"
        );

        $result = $this->object->moveItem($var_id, $wish_list_id);
        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertEquals('Операция успешна', $result);
    }

    public function moveItem_provider() {
        return array(
            array(1, 1),
            array(2, 2),
            array(3, 3)
        );
    }

    /**
     * @covers wishlist\classes\BaseApi::all
     * @todo   Implement testAll().
     */
    public function testAll() {

        $this->assertNotEmpty($this->object->all());

        $this->assertInternalType('array', $this->object->all());
    }

    /**
     * @covers wishlist\classes\BaseApi::getMostViewedWishLists
     * @todo   Implement testGetMostViewedWishLists().
     */
    public function testGetMostViewedWishLists() {

        $this->assertNotEmpty($this->object->getMostViewedWishLists());

        $this->assertInternalType('array', $this->object->getMostViewedWishLists());

        $this->assertGreaterThan(0, $this->object->getMostViewedWishLists());
    }

    /**
     * @covers wishlist\classes\BaseApi::user
     * @todo   Implement testUser().
     */
    public function testUser() {
        $this->assertNotEmpty($this->object->user(47));

        $this->assertInternalType('array', $this->object->user(47));

        $this->assertGreaterThan(0, $this->object->user(47));
    }

    /**
     * @covers wishlist\classes\BaseApi::getMostPopularItems
     * @todo   Implement testGetMostPopularItems().
     */
    public function testGetMostPopularItems() {

        $this->assertNotEmpty($this->object->getMostPopularItems());

        $this->assertInternalType('array', $this->object->getMostPopularItems());

        $this->assertGreaterThan(0, $this->object->getMostPopularItems());
    }

    /**
     * @covers wishlist\classes\BaseApi::createWishList
     * @todo   Implement testCreateWishList().
     */
    public function testCreateWishList() {
        $result = $this->object->createWishList();
        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertRegExp('/Создано/', $result);
    }

    /**
     * @covers wishlist\classes\BaseApi::renderPopup
     * @todo   Implement testRenderPopup().
     */
    public function testRenderPopup() {
        $this->assertNotEmpty($this->object->renderPopup());

        $this->assertInternalType('array', $this->object->renderPopup());
    }

    /**
     * @covers wishlist\classes\BaseApi::show
     * @todo   Implement testShow().
     */
    public function testShow() {
        $model = new \Wishlist_model();
        $model->upateWishList(1, array('access' => 'public', 'hash' => '222'));

        $this->assertNotEmpty($this->object->show('222'));

        $this->assertInternalType('array', $this->object->show('222'));

        $this->assertCount(1, $this->object->show('222'));
    }

    /**
     * @covers wishlist\classes\BaseApi::deleteItem
     * @todo   Implement testDeleteItem().
     */
    public function testDeleteItem() {
        $result = $this->object->deleteItem(1, 4);

        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertRegExp('/Операция успешна/', $result);
    }

    /**
     * @covers wishlist\classes\BaseApi::deleteItemByIds
     * @todo   Implement testDeleteItemByIds().
     */
    public function testDeleteItemByIds() {
        $result = $this->object->deleteItemByIds();
        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertRegExp('/Успешно удалено/', $result);
    }

    /**
     * @covers wishlist\classes\BaseApi::userUpdate
     * @todo   Implement testUserUpdate().
     */
    public function testUserUpdate() {
        $_POST['description'] = "test desc";
        $_POST['user_birthday'] = 112341234;
        $_POST['user_id'] = 47;
        $_POST['user_name'] = "test_name";

        $result = $this->object->userUpdate();
        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
        $this->assertRegExp('/Обновлено/', $result);
    }


    /**
     * @covers wishlist\classes\BaseApi::deleteWL
     * @todo   Implement testDeleteWL().
     */
    public function testDeleteWL() {
        $result = $this->object->deleteWL(2);
        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertRegExp('/Успешно удалено/', $result);
    }

    /**
     * @covers wishlist\classes\BaseApi::updateWL
     * @todo   Implement testUpdateWL().
     */
    public function testUpdateWL() {
        $_POST['WLID'] = 3;
        $_POST['comment'] = "test_wl_comment";
        $_POST['title'] = "test title";
        $_POST['access'] = array('public');
        $result = $this->object->updateWL();
        var_dumps($result);
        
    }
//
//    /**
//     * @covers wishlist\classes\BaseApi::deleteImage
//     * @todo   Implement testDeleteImage().
//     */
//    public function testDeleteImage() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }
//
//    /**
//     * @covers wishlist\classes\BaseApi::do_upload
//     * @todo   Implement testDo_upload().
//     */
//    public function testDo_upload() {
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
//    }
}
