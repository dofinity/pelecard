<?php
/**
 * @file PaymentRequestTest class - tests PaymentRequest class.
 */
namespace Pelecard;

use PHPUnit\Framework\TestCase;
use Pelecard\PaymentRequest;

class PaymentRequestTest extends TestCase {

  /**
   * Tests setUserData method with wrong $fieldName arguments
   *
   * @dataProvider provideWrongUserDataFieldName
   * @expectedException InvalidArgumentException
   * @expectedExceptionMessage Invalid `$fieldName`. Keys UserData1, UserData2, ...UserData15 are allowed
   * @covers Pelecard\PaymentRequest::setUserData
   */
  public function testSetUserDataWithWrongFieldNames($fieldName) {
    $req = new PaymentRequest('0123456','user','qwerty','http://hostname/good.php',100);
    // fill out other UserData fields to trace any change
    for($i=1; $i<16; $i++) {
      $req->setUserData("UserData{$i}", "test{$i}");
    }
    $beforeReqJson = $req->jsonSerialize();
    if (is_scalar($fieldName)) {
      $req->setUserData($fieldName, "test{$fieldName}");
    } elseif ($fieldName instanceof \JsonSerializable) {
      $req->setUserData($fieldName, "test{json_encode($fieldName)}");
    } elseif ($fieldName instanceof \Serializable) {
      $req->setUserData($fieldName, "test{$fieldName->serialize()}");
    } else {
      $req->setUserData($fieldName, "testNotSerializable");
    }
    $afterReqJson = $req->jsonSerialize();
    // request shouldn't be changed after wrong value assign
    $this->assertJsonStringEqualsJsonString(json_encode($beforeReqJson), json_encode($afterReqJson));
  }

  /**
   * Tests setUserData method with correct $fieldName arguments
   *
   * @dataProvider provideCorrectUserDataFieldName
   * @covers Pelecard\PaymentRequest::setUserData
   */
  public function testSetUserDataWithCorrectFieldNames($fieldName) {
    $req = new PaymentRequest('0123456','user','qwerty','http://hostname/good.php',100);
    // fill out other UserData fields to trace any change
    for($i=1; $i<16; $i++) {
      $req->setUserData("UserData{$i}", "test{$i}");
    }
    $beforeReqJson = $req->jsonSerialize();
    $req->setUserData($fieldName, "test{$fieldName}");
    $afterReqJson = $req->jsonSerialize();
    // updated field should be different
    $this->assertNotSame($beforeReqJson['UserData'][$fieldName], $afterReqJson['UserData'][$fieldName]);
    // now update field in old object and compare entire JSON again
    $beforeReqJson['UserData'][$fieldName] = "test{$fieldName}";
    $this->assertJsonStringEqualsJsonString(json_encode($beforeReqJson), json_encode($afterReqJson));
  }

  /**
   * Tests setUserData method with wrong $data arguments
   *
   * @dataProvider provideWrongUserData
   * @expectedException InvalidArgumentException
   * @expectedExceptionMessage Invalid `$data`. Data must be string or `null` when you need to unset it
   * @covers Pelecard\PaymentRequest::setUserData
   */
  public function testSetUserDataWithWrongData($data) {
    $req = new PaymentRequest('0123456','user','qwerty','http://hostname/good.php',100);
    // fill out other UserData fields to trace any change
    for($i=1; $i<16; $i++) {
      $req->setUserData("UserData{$i}", "test{$i}");
    }
    $beforeReqJson = $req->jsonSerialize();
    $req->setUserData('UserData1', $data);
    $afterReqJson = $req->jsonSerialize();
    // request shouldn't be changed after wrong value assign
    $this->assertJsonStringEqualsJsonString(json_encode($beforeReqJson), json_encode($afterReqJson));
  }

  /**
   * Tests setUserData method with correct $data arguments
   *
   * @dataProvider provideCorrectUserData
   * @covers Pelecard\PaymentRequest::setUserData
   */
  public function testSetUserDataWithCorrectData($data) {
    $req = new PaymentRequest('0123456','user','qwerty','http://hostname/good.php',100);
    // fill out other UserData fields to trace any change
    for($i=1; $i<16; $i++) {
      $req->setUserData("UserData{$i}", "test{$i}");
    }
    $beforeReqJson = $req->jsonSerialize();
    $req->setUserData('UserData1', $data);
    $afterReqJson = $req->jsonSerialize();
    // updated field should be different
    $this->assertNotSame($beforeReqJson['UserData']['UserData1'], $afterReqJson['UserData']['UserData1']);
    // now update field in old object and compare entire JSON again
    $beforeReqJson['UserData']['UserData1'] = $data;
    $this->assertJsonStringEqualsJsonString(json_encode($beforeReqJson), json_encode($afterReqJson));
  }

  public function provideWrongUserDataFieldName() {
    return [
      [null],
      [1],
      ['foo'],
      ['bar'],
      [[]],
      [new \DateTime()],
      [new \StdClass()],
      ['userdata1'],
      ['USERDATA1'],
      ['USERDATA1'],
      ['UserData2018'],
      ['PUserData1'],
      ['PUserData1P'],
      ['UserData0'],
      ['UserData01'],
      ['UserData16'],
      ['UserData21'],
      ['UserData26'],
    ];
  }

  public function provideCorrectUserDataFieldName() {
    return [
      ['UserData1'],
      ['UserData2'],
      ['UserData3'],
      ['UserData4'],
      ['UserData5'],
      ['UserData6'],
      ['UserData7'],
      ['UserData8'],
      ['UserData9'],
      ['UserData10'],
      ['UserData11'],
      ['UserData12'],
      ['UserData13'],
      ['UserData14'],
      ['UserData15'],
    ];
  }

  public function provideWrongUserData() {
    return [
      [false],
      [true],
      [0],
      [1],
      [3.14],
      [-3.14],
      [new \DateTime()],
      [new \StdClass()],
      [[]],
      [['user', 'john', 'invoice', '00001']],
      [['user' => 'john', 'invoice' => '00001']],
    ];
  }

  public function provideCorrectUserData() {
    return [
      [null],
      ['LoremIpsumDolor'],
      ['invoice00001'],
      ['?user=john&invoice_no=00001'],
      ['{"user":"john","invoice":"00001"}'],
    ];
  }

}
