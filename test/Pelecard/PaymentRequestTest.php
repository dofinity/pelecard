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
   * @covers Pelecard\PaymentRequest::setUserData
   */
  public function testSetUserDataWithWrongFieldNames($fieldName) {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Invalid `$fieldName`. Keys UserData1, UserData2, ...UserData15 are allowed');

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
   * @covers Pelecard\PaymentRequest::setUserData
   */
  public function testSetUserDataWithWrongData($data) {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Invalid `$data`. Data must be string or `null` when you need to unset it');

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

  /**
   * Tests QAResultStatus property with wrong $value
   *
   * @dataProvider provideWrongQAResultStatus
   * @covers Pelecard\PaymentRequest::setQAResultStatus
   */
  public function testQAStatusCodePropertyWithWrongValue($value) {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Invalid `$QAResultStatus`. Data must be three-digit status code, eg \'000\' or `null` when you need to unset it');

    $req = new PaymentRequest('0123456','user','qwerty','http://hostname/good.php',100);
    $req->setQAResultStatus($value);
  }

  /**
   * Tests QAResultStatus property with correct $value
   *
   * @dataProvider provideCorrectQAResultStatus
   * @covers Pelecard\PaymentRequest::setQAResultStatus
   * @covers Pelecard\PaymentRequest::jsonSerialize
   */
  public function testQAResultStatusPropertyWithCorrectValue($value) {
    $req = new PaymentRequest('0123456','user','qwerty','http://hostname/good.php',100);
    $req->setQAResultStatus($value);

    $reqJson = $req->jsonSerialize();
    if ($value === null || $value === NULL) {
      // need to check that value and key has been removed
      $this->assertArrayNotHasKey('QAResultStatus', $reqJson);
      return;
    }

    $this->assertArrayHasKey('QAResultStatus', $reqJson);
    $this->assertEquals($value, $reqJson['QAResultStatus']);
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

  public function provideWrongQAResultStatus() {
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
      [000],
      ['0000'],
      ['00'],
      ['statuscode'],
    ];
  }

  public function provideCorrectQAResultStatus() {
    return [
      [null],
      [NULL],
      ['000'],
      ['001'], ['002'], ['003'], ['004'], ['005'], ['006'], ['007'], ['008'], ['009'],
      ['010'], ['011'], ['012'], ['013'], ['014'], ['015'], ['016'], ['017'], ['018'], ['019'],
      ['020'], ['021'], ['022'], ['023'], ['024'], ['025'], ['026'], ['027'], ['028'], ['029'],
      ['030'], ['031'], ['032'], ['033'], ['034'], ['035'], ['036'], ['037'], ['038'], ['039'],
      ['040'], ['041'], ['042'], ['043'], ['044'], ['045'], ['046'], ['047'],
      ['051'], ['052'], ['053'], ['057'], ['058'], ['059'],
      ['060'], ['061'], ['062'], ['063'], ['064'], ['065'], ['066'], ['067'], ['068'], ['069'],
      ['070'], ['071'], ['072'], ['073'], ['074'], ['075'], ['076'], ['077'], ['079'],
      ['080'],
      ['090'], ['091'], ['092'], ['099'],
      ['101'], ['106'], ['107'], ['108'], ['109'],
      ['110'], ['111'], ['112'], ['113'], ['114'], ['115'], ['116'], ['117'], ['118'], ['119'],
      ['120'], ['121'], ['122'], ['123'], ['124'], ['125'], ['126'], ['127'], ['128'], ['129'],
      ['130'], ['131'], ['132'], ['133'], ['134'], ['135'], ['136'], ['137'], ['138'], ['139'],
      ['130'], ['131'], ['132'], ['133'], ['134'], ['135'], ['136'], ['137'], ['138'], ['139'],
      ['140'], ['141'], ['142'], ['143'], ['144'], ['145'], ['146'], ['147'], ['148'], ['149'],
      ['150'], ['151'], ['152'], ['153'], ['154'], ['155'], ['156'], ['157'], ['158'], ['159'],
      ['160'], ['161'], ['162'], ['163'], ['164'], ['165'], ['166'], ['167'], ['168'], ['169'],
      ['170'], ['171'], ['172'], ['173'], ['174'], ['175'], ['176'], ['177'], ['178'], ['179'],
      ['180'],
      ['200'], ['201'], ['205'],
      ['306'], ['308'],
      ['404'],
      ['500'], ['501'], ['502'], ['503'], ['505'], ['506'], ['507'], ['508'], ['509'],
      ['510'],
      ['597'], ['598'], ['599'],
      ['999'],
    ];
  }

}
