<?php

namespace wishlist\classes;

require_once realpath(dirname(__FILE__) . '/../../../..') . '/enviroment.php';

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
     * @dataProvider _addItem_provider
     */
    public function test_addItem($var_id) {
        $result = $this->object->_addItem($var_id);
        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertRegExp('/Добавлено/', $result);
        
        //--------If wish list name is longer 
        $_POST[ 'wishListName'] = "ddddddddddddddddddddddddddddddddddddddddddddd
                                   ddddddddddddddddddddddddddddddddddddddddddddd
                                   ddddddddddddddddddddddddddddddddddddddddddddd
                                   ddddddddddddddddddddddddddddddddddddddddddddd
                                   ddddddddddddddddddddddddddddddddddddddddddddd
                                   ddddddddddddddd";
        $result = $this->object->_addItem($var_id);
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertRegExp('/Название Списка Желаний будет изменено/', $result[0]);
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

        $this->assertRegExp('/Операция успешна/', $result);
        
        
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
     */
    public function testAll() {

        $this->assertNotEmpty($this->object->all());

        $this->assertInternalType('array', $this->object->all());
    }

    /**
     * @covers wishlist\classes\BaseApi::getMostViewedWishLists
     */
    public function testGetMostViewedWishLists() {

        $this->assertNotEmpty($this->object->getMostViewedWishLists());

        $this->assertInternalType('array', $this->object->getMostViewedWishLists());

        $this->assertGreaterThan(0, $this->object->getMostViewedWishLists());
    }

  

    /**
     * @covers wishlist\classes\BaseApi::getMostPopularItems
     */
    public function testGetMostPopularItems() {

        $this->assertNotEmpty($this->object->getMostPopularItems());

        $this->assertInternalType('array', $this->object->getMostPopularItems());

        $this->assertGreaterThan(0, $this->object->getMostPopularItems());
    }

    /**
     * @covers wishlist\classes\BaseApi::createWishList
     */
    public function testCreateWishList() {
        $result = $this->object->createWishList();
        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
        $this->assertRegExp('/Создано/', $result);
        
        //----------Create list over limit
        
        $result = $this->object->createWishList();
        
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertRegExp('/Лимит Списков Желаний исчерпан/', $result[0]);
    }
    

    /**
     * @covers wishlist\classes\BaseApi::renderPopup
     */
    public function testRenderPopup() {
        $this->assertNotEmpty($this->object->renderPopup());

        $this->assertInternalType('array', $this->object->renderPopup());
    }

    /**
     * @covers wishlist\classes\BaseApi::show
     */
    public function testShow() {
        $model = new \Wishlist_model();
        $model->updateWishList(1, array('access' => 'public', 'hash' => '222'));
        $result = $this->object->show('222');
        
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertCount(1, $result);
        
        //----------- Try to get not existing list
        $result = $this->object->show('32323');
        
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertCount(1, $result);
        $this->assertRegExp('/Неверний запрос/', $result[0]);
        
        //----------- Try to get private list
        $model->updateWishList(5, array('access' => 'private', 'hash' => '4444'));
        $result = $this->object->show('4444');
        
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertRegExp('/Неверний запрос/', $result[0]);
    }

    

    /**
     * @covers wishlist\classes\BaseApi::userUpdate
     */
    public function testUserUpdate() {
        $_POST['description'] = "test desc";
        $_POST['user_birthday'] = 112341234;
        $_POST['user_id'] = $GLOBALS['userId'] ;
        $_POST['user_name'] = "test_name";

        $result = $this->object->userUpdate();
        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
        $this->assertRegExp('/Обновлено/', $result);
    }


   

    /**
     * @covers wishlist\classes\BaseApi::updateWL
     */
    public function testUpdateWL() {
        $_POST['WLID'] = 3;
        $_POST['comment'] = "test_wl_comment";
        $_POST['title'] = "test title";
        $_POST['access'] = 'public';

        $result = $this->object->updateWL();

        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertRegExp('/Обновлено/', $result[0]);
        
        $_POST['WLID'] = 3343;
        $_POST['comment'] = "test_wl_comment";
        $_POST['title'] = "test title";
        $_POST['access'] = 'public';

        $result = $this->object->updateWL();
        
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertRegExp('/Не обновлено/', $result[0]);
    }

    /**
     * @covers wishlist\classes\BaseApi::do_upload
     */
    public function testDo_uploadUserIDError() {
        $result = $this->object->do_upload();

        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
        $this->assertRegExp('/Не введен пользователь/', $result);
    }

    /**
     * @covers wishlist\classes\BaseApi::deleteImage
     */
    public function testDeleteImage() {
        $_POST['image'] = 'test_image.jpg';
        write_file('../../../../../uploads/mod_wishlist/test_image.jpg') ;
        $result = $this->object->deleteImage();

        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
        $this->assertRegExp('/Успешно удалено/', $result);

        //-----При неверном имени изобраєения------------
        $_POST['image'] = 'wrong_image_name.jpg';
        write_file('../../../../../uploads/mod_wishlist/test_image.jpg') ;
        $result = $this->object->deleteImage();

        $this->assertNotEmpty($result);
        $this->assertInternalType('string', $result);
        $this->assertRegExp('/Ошибка/', $result);
    }
    
    /**
     * @covers wishlist\classes\BaseApi::user
     */
    public function testUser() {
        $result = $this->object->user($GLOBALS['userId'] );
        
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertGreaterThan(0, $result);
        
        //------------If user not exist
        $result = $this->object->user(400);
        
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertRegExp('/Неверний запрос/', $result[0]);
    }
    
     /**
     * @covers wishlist\classes\BaseApi::deleteWL
     */
    public function testDeleteWL() {
        $result = $this->object->deleteWL(2);
        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertRegExp('/Успешно удалено/', $result);
        
        //-------Delete not existing wish list
        $result = $this->object->deleteWL(200);
        
        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
        $this->assertRegExp('/Невозможно удалить Список Желаний/', $result[0]);
    }
     /**
     * @covers wishlist\classes\BaseApi::deleteItemsByIds
     */
    public function testDeleteItemsByIds() {
        $result = $this->object->deleteItemsByIds();
        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertRegExp('/Операция успешна/', $result);
    }
    /**
     * @covers wishlist\classes\BaseApi::deleteItem
     */
    public function testDeleteItem() {
        $result = $this->object->deleteItem(2, 4);
        
        $this->assertNotEmpty($result);

        $this->assertInternalType('string', $result);

        $this->assertRegExp('/Операция успешна/', $result);
    }
    

}
