<?php
/**
 * @file PelecardStatusMessageTest class - tests PelecardStatusMessage class.
 */
namespace Pelecard;

use PHPUnit\Framework\TestCase;
use Pelecard\PelecardPaymentStatus;

class PelecardPaymentStatusTest extends TestCase {

  /**
   * Tests getCode method with good params
   *
   * @dataProvider provideCorrectStatusCodesAndMessages
   * @covers Pelecard\PelecardPaymentStatus::getCode
   */
  public function testGetCodeWithCorrectParams($statusCode) {
    $status = new PelecardPaymentStatus($statusCode);
    $this->assertEquals($statusCode, $status->getCode());
  }

  /**
   * Tests getMessage method with good params
   *
   * @dataProvider provideCorrectStatusCodesAndMessages
   * @covers Pelecard\PelecardPaymentStatus::getMessage
   */
  public function testGetMessageWithCorrectParams($statusCode, $expectedMessage, $locale) {
    $status = new PelecardPaymentStatus($statusCode, $locale);
    $this->assertEquals($expectedMessage, $status->getMessage());
  }

  /**
   * Tests getMessage method with wrong params
   *
   * @dataProvider provideInvalidStatusCodes
   * @covers Pelecard\PelecardPaymentStatus::getMessage
   */
  public function testGetMessageWithWrongParams($statusCode, $locale) {
    $status = new PelecardPaymentStatus($statusCode, $locale);
    $this->assertNull($status->getMessage());
  }

  /**
   * Tests toString magic method with good params
   *
   * @dataProvider provideCorrectStatusCodesAndMessages
   * @covers Pelecard\PelecardPaymentStatus::__toString
   */
  public function testToStringWithCorrectParams($statusCode, $expectedMessage, $locale) {
    $status = new PelecardPaymentStatus($statusCode, $locale);
    $this->assertInternalType('string', (string) $status);
    $this->assertEquals($expectedMessage, (string) $status);
  }

  /**
   * Tests toString magic method with wrong params
   *
   * @dataProvider provideInvalidStatusCodes
   * @covers Pelecard\PelecardPaymentStatus::__toString
   */
  public function testToStringWithWrongParams($statusCode, $locale) {
    $status = new PelecardPaymentStatus($statusCode, $locale);
    $this->assertEquals('', (string) $status);
  }

  public function provideCorrectStatusCodesAndMessages() {
    return [
      // hebrew locale examples
      ['000', 'תקין', 'he'],
      ['010', 'תוכנית הופסקה עפ"י הוראת המפעיל (ESC) או COM PORT לא ניתן לפתיחה (WINDOWS).', 'HE'],
      ['043', 'אקראית כאשר קובץ הקלט מכיל J1  (אסור להתקשר).', 'he'],
      ['069', 'אורך הפס המגנטי קצר מידי.', 'HE'],
      ['119', 'למסוף אין אישור לאשראי אמקס  קרדיט.', 'he'],
      ['170', 'סכום הנחה בכוכבים/נקודות/מיילים גדול מהמותר.', 'He'],
      ['171', 'לא ניתן לבצע עיסקה מאולצת לכרטיס/אשראי חיוב מיידי.', 'he'],
      ['200', 'שגיאה יישומית.', 'he'],
      ['306', 'אין תקשורת לפלא קארד.', 'he'],
      ['404', 'מסוף שגוי.', 'he'],
      ['505', 'מסוף חסום אנא פנה להנהלת חשבונות.', 'hE'],
      ['599', 'שגיאה כללית אנא פנה למחלקת התמיכה.', 'he'],

      // english locale examples
      ['000', 'Permitted transaction.', 'en'],
      ['010', 'The program was stopped by user\'s command (ESC) or COM PORT can\'t be open (Windows)', 'EN'],
      ['043', 'Random where input file contains J1 (contact prohibited).', 'en'],
      ['069', 'The magnetic strip is too short.', 'en'],
      ['119', 'The terminal is not authorized for Amex credit.', 'EN'],
      ['170', 'Amount of discount on stars/points/miles is higher than the permitted.', 'eN'],
      ['171', 'Forced transactions cannot be executed with credit/immediate debit card.', 'en'],
      ['200', 'Application error.', 'en'],
      ['306', 'No communication to Pelecard.', 'EN'],
      ['404', 'Terminal number does not exist.', 'en'],
      ['505', 'Blocked terminal. Please contact account team.', 'en'],
      ['599', 'General error. Repeat action.', 'En'],

      // next fixtures expects hebrew because of unsupported/invalid locale
      ['200', 'שגיאה יישומית.', 'fr'],
      ['306', 'אין תקשורת לפלא קארד.', 'hebrew'],
      ['404', 'מסוף שגוי.', 'english'],
      ['505', 'מסוף חסום אנא פנה להנהלת חשבונות.', 'br'],
      ['599', 'שגיאה כללית אנא פנה למחלקת התמיכה.', 'it'],

      // next fixtures expects english because there is no hebrew translation
      ['509', 'SSL verifying access is blocked. Please contact support team.', 'he'],
      ['510', 'Data not exist.', 'he'],
      ['597', 'General error. Please contact support team.', 'he'],
      ['598', 'Necessary values are blocked/wrong.', 'he'],
      ['999', 'Necessary values missing to complete installments transaction.', 'he'],
    ];
  }

  public function provideInvalidStatusCodes() {
    return [
      [null, 'he'],
      [1, 'en'],
      [3.14, 'en'],
      ['foo', 'en'],
      ['bar', 'he'],
      [new \DateTime(), 'en'],
      [new \StdClass(), 'he'],
      [200, 'he'],
      [-404, 'he'],
      ['1', 'he'],
      ['181', 'he'],
      ['600', 'he'],
      ['666', 'he'],
      ['100500', 'en'],
      ['success', 'en'],
      ['010101', 'en'],
    ];
  }
}
