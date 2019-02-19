<?php
/**
 * @file PelecardPaymentStatus class - allows to get payment status message based on status code
 */
namespace Pelecard;

class PelecardPaymentStatus {

  /* @var array Payment status messages, english version */
  const MESSAGES_EN = [
    '000' => 'Permitted transaction.',
    '001' => 'The card is blocked, confiscate it.',
    '002' => 'The card is stolen, confiscate it.',
    '003' => 'Contact the credit company.',
    '004' => 'Refusal by credit company.',
    '005' => 'The card is forged, confiscate it.',
    '006' => 'Incorrect CVV/ID.',
    '007' => 'Incorrect CAVV/ECI/UCAF.',
    '008' => 'An error occurred while building access key for blocked card files.',
    '009' => 'No communication. Please try again or contact System Administration',
    '010' => 'The program was stopped by user\'s command (ESC) or COM PORT can\'t be open (Windows)',
    '011' => 'The acquirer is not authorized for foreign currency transactions',
    '012' => 'This card is not permitted for foreign currency transactions',
    '013' => 'The terminal is not permitted for foreign currency charge/discharge into this card',
    '014' => 'This card is not Supported.',
    '015' => 'Track 2 (Magnetic) does not match the typed data.',
    '016' => 'Additional required data was entered/not entered as opposed to terminal Settings (Z field).',
    '017' => 'Last 4 digits were not entered (W field).',
    '019' => 'Entry in INT_IN file is shorter than 16 characters.',
    '020' => 'The input file (INT_IN) does not exist.',
    '021' => 'Blocked cards file (NEG) does not exist or has not been updated, transmit or request authorization for each transaction.',
    '022' => 'One of the parameter files/vectors does not exist.',
    '023' => 'Date file (DATA) does not exist.',
    '024' => 'Format file (START) does not exist.',
    '025' => 'The difference in days in the blocked cards input is too large, transmit or request authorization for each transaction.',
    '026' => 'The difference in generations in the blocked cards input is too large, transmit or request authorization for each transaction.',
    '027' => 'When the magnetic strip is not completely entered, define the transaction as a telephone number or signature only.',
    '028' => 'The central terminal number was not entered into the defined main supplier terminal.',
    '029' => 'The beneficiary number was not entered into the defined main beneficiary terminal.',
    '030' => 'The supplier/beneficiary number was entered, however the terminal was not updated as the main supplier/beneficiary.',
    '031' => 'The beneficiary number was entered, however the terminal was updated as the main supplier.',
    '032' => 'Old transactions, transmit or request authorization for each transaction.',
    '033' => 'Defective card.',
    '034' => 'This card is not permitted for this terminal or is not authorized for this type of transaction.',
    '035' => 'This card is not permitted for this transaction or type of credit.',
    '036' => 'Expired card.',
    '037' => 'Installment error, the amount of transactions needs to be equal to: first installment plus fixed installments times number of installments.',
    '038' => 'Unable to execute a debit transaction that is higher than the credit card`s ceiling.',
    '039' => 'Incorrect control number.',
    '040' => 'The beneficiary and supplier numbers were entered, however the terminal is defined as main.',
    '041' => 'The transaction`s amount exceeds the ceiling when the input file contains J1, J2 or J3 (contact prohibited).',
    '042' => 'The card is blocked for the supplier where input file contains J1, J2 or J3 (contact prohibited).',
    '043' => 'Random where input file contains J1 (contact prohibited).',
    '044' => 'The terminal is prohibited from requesting authorization without transaction (J5).',
    '045' => 'The terminal is prohibited for supplier-initiated authorization request (J6).',
    '046' => 'The terminal must request authorization where the input file contains J1, J2 or J3 (contact prohibited).',
    '047' => 'Secret code must be entered where input file contains J1, J2 or J3 (contact prohibited).',
    '051' => 'Incorrect vehicle number.',
    '052' => 'The number of the distance meter was not entered.',
    '053' => 'The terminal is not defined as gas station (petrol card or incorrect transaction code was used).',
    '057' => 'An ID number is required (for Israeli cards only) but was not entered.',
    '058' => 'CVV is required but was not entered.',
    '059' => 'CVV and ID number are required (for Israeli cards only) but were not entered.',
    '060' => 'ABS attachment was not found at the beginning of the input data in memory.',
    '061' => 'The card number was either not found or found twice.',
    '062' => 'Incorrect transaction type.',
    '063' => 'Incorrect transaction code.',
    '064' => 'Incorrect credit type.',
    '065' => 'Incorrect currency.',
    '066' => 'The first installment and/or fixed payment are for non-installment type of credit.',
    '067' => 'Number of installments exist for the type of credit that does not require this.',
    '068' => 'Linkage to dollar or index is possible only for installment credit.',
    '069' => 'The magnetic strip is too short.',
    '070' => 'The PIN code device is not defined.',
    '071' => 'Must enter the PIN code number.',
    '072' => 'Smart card reader not available - use the magnetic reader.',
    '073' => 'Must use the Smart card reader.',
    '074' => 'Denied - locked card.',
    '075' => 'Denied - Smart card reader action didn\'t end in the correct time.',
    '076' => 'Denied - Data from smart card reader not defined in system.',
    '077' => 'Incorrect PIN code.',
    '079' => 'Currency does not exist in vector 59.',
    '080' => 'The club code entered does not match the credit type.',
    '090' => 'Cannot cancel charge transaction. Make charging deal.',
    '091' => 'Cannot cancel charge transaction. Make discharge transaction',
    '092' => 'Cannot cancel charge transaction. Please create a credit transaction.',
    '099' => 'Unable to read/write/open the TRAN file.',
    '101' => 'No authorization from credit company for clearance.',
    '106' => 'The terminal is not permitted to send queries for immediate debit cards.',
    '107' => 'The transaction amount is too large, divide it into a number of transactions.',
    '108' => 'The terminal is not authorized to execute forced transactions.',
    '109' => 'The terminal is not authorized for cards with service code 587.',
    '110' => 'The terminal is not authorized for immediate debit cards.',
    '111' => 'The terminal is not authorized for installment transactions.',
    '112' => 'The terminal is authorized for installment transactions only, not telephone/signature.',
    '113' => 'The terminal is not authorized for telephone transactions.',
    '114' => 'The terminal is not authorized for signature-only transactions.',
    '115' => 'The terminal is not authorized for foreign currency transactions, or transaction is not authorized.',
    '116' => 'The terminal is not authorized for club transactions.',
    '117' => 'The terminal is not authorized for star/point/mile transactions.',
    '118' => 'The terminal is not authorized for Isracredit credit.',
    '119' => 'The terminal is not authorized for Amex credit.',
    '120' => 'The terminal is not authorized for dollar linkage.',
    '121' => 'The terminal is not authorized for index linkage.',
    '122' => 'The terminal is not authorized for index linkage with foreign cards.',
    '123' => 'The terminal is not authorized for star/point/mile transactions for this type of credit.',
    '124' => 'The terminal is not authorized for Isra 36 credit.',
    '125' => 'The terminal is not authorized for Amex 36 credit.',
    '126' => 'The terminal is not authorized for this club code.',
    '127' => 'The terminal is not authorized for immediate debit transactions (except for immediate debit cards).',
    '128' => 'The terminal is not authorized to accept Visa card staring with 3.',
    '129' => 'The terminal is not authorized to execute credit transactions above the ceiling.',
    '130' => 'The card is not permitted to execute club transactions.',
    '131' => 'The card is not permitted to execute star/point/mile transactions.',
    '132' => 'The card is not permitted to execute dollar transactions (regular or telephone).',
    '133' => 'The card is not valid according to Isracard`s list of valid cards.',
    '134' => 'Defective card according to system definitions (Isracard VECTOR1), error in the number of figures on the card.',
    '135' => 'The card is not permitted to execute dollar transactions according to system definitions (Isracard VECTOR1).',
    '136' => 'The card belongs to a group that is not permitted to execute transactions according to system definitions (Visa VECTOR 20).',
    '137' => 'The card`s prefix (7 figures) is invalid according to system definitions (Diners VECTOR21).',
    '138' => 'The card is not permitted to carry out installment transactions according to Isracard`s list of valid cards.',
    '139' => 'The number of installments is too large according to Isracard`s list of valid cards.',
    '140' => 'Visa and Diners cards are not permitted for club installment transactions.',
    '141' => 'Series of cards are not valid according to system definition (Isracard VECTOR5).',
    '142' => 'Invalid service code according to system definitions (Isracard VECTOR6).',
    '143' => 'The card`s prefix (2 figures) is invalid according to system definitions (Isracard VECTOR7).',
    '144' => 'Invalid service code according to system definitions (Visa VECTOR12).',
    '145' => 'Invalid service code according to system definitions (Visa VECTOR13).',
    '146' => 'Immediate debit card is prohibited for executing credit transaction.',
    '147' => 'The card is not permitted to execute installment transactions according to Alpha vector no. 31.',
    '148' => 'The card is not permitted for telephone and signature-only transactions according to Alpha vector no. 31.',
    '149' => 'The card is not permitted for telephone transactions according to Alpha vector no. 31.',
    '150' => 'Credit is not approved for immediate debit cards.',
    '151' => 'Credit is not approved for foreign cards.',
    '152' => 'Incorrect club code.',
    '153' => 'The card is not permitted to execute flexible credit transactions (Adif/30+) according to system definitions (Diners VECTOR21).',
    '154' => 'The card is not permitted to execute immediate debit transactions according to system definitions (Diners VECTOR21).',
    '155' => 'The payment amount is too low for credit transactions.',
    '156' => 'Incorrect number of installments for credit transaction.',
    '157' => 'Zero ceiling for this type of card for regular credit or Credit transaction.',
    '158' => 'Zero ceiling for this type of card for immediate debit credit transaction.',
    '159' => 'Zero ceiling for this type of card for immediate debit in dollars.',
    '160' => 'Zero ceiling for this type of card for telephone transaction.',
    '161' => 'Zero ceiling for this type of card for credit transaction.',
    '162' => 'Zero ceiling for this type of card for installment transaction.',
    '163' => 'American Express card issued abroad not permitted for instalments transaction.',
    '164' => 'JCB cards are only permitted to carry out regular credit transactions.',
    '165' => 'The amount in stars/points/miles is higher than the transaction amount.',
    '166' => 'The club card is not within terminal range.',
    '167' => 'Star/point/mile transactions cannot be executed.',
    '168' => 'Dollar transactions cannot be executed for this type of card.',
    '169' => 'Credit transactions cannot be executed with other than regular credit.',
    '170' => 'Amount of discount on stars/points/miles is higher than the permitted.',
    '171' => 'Forced transactions cannot be executed with credit/immediate debit card.',
    '172' => 'The previous transaction cannot be cancelled (credit transaction or card number are not identical).',
    '173' => 'Double transaction.',
    '174' => 'The terminal is not permitted for index linkage of this type of credit.',
    '175' => 'The terminal is not permitted for dollar linkage of this type of credit.',
    '176' => 'The card is invalid according to system definitions (Isracard VECTOR1).',
    '177' => 'Unable to execute the self-service transaction if the gas station does not have self service.',
    '178' => 'Credit transactions are forbidden with stars/points/miles.',
    '179' => 'Dollar credit transactions are forbidden on tourist cards.',
    '180' => 'Phone transactions are not permitted on Club cards.',
    '200' => 'Application error.',
    '201' => 'Error receiving encrypted data',
    '205' => 'Transaction amount missing or zero.',
    '306' => 'No communication to Pelecard.',
    '308' => 'Doubled transaction.',
    '404' => 'Terminal number does not exist.',
    '500' => 'Terminal executes broadcast and/or updating data. Please try again later.',
    '501' => 'User name and/or password not correct. Please call support team.',
    '502' => 'User password has expired. Please contact support team.',
    '503' => 'Locked user. Please contact support team.',
    '505' => 'Blocked terminal. Please contact account team.',
    '506' => 'Token number abnormal.',
    '507' => 'User is not authorized in this terminal.',
    '508' => 'Validity structure invalid. Use MMYY structure only.',
    '509' => 'SSL verifying access is blocked. Please contact support team.',
    '510' => 'Data not exist.',
    '597' => 'General error. Please contact support team.',
    '598' => 'Necessary values are blocked/wrong.',
    '599' => 'General error. Repeat action.',
    '999' => 'Necessary values missing to complete installments transaction.',
  ];

  /* @var array Payment status messages, hebrew version */
  const MESSAGES_HE = [
    '000' => 'תקין',
    '001' => 'חסום החרם כרטיס.',
    '002' => 'גנוב החרם כרטיס.',
    '003' => 'התקשר לחברת האשראי.',
    '004' => 'סירוב.',
    '005' => 'מזויף החרם כרטיס.',
    '006' => 'חובה להתקשר לחברת האשראי.',
    '008' => 'תקלה בבניית מפתח גישה לקובץ חסומים.',
    '009' => 'לא הצליח להתקשר.',
    '010' => 'תוכנית הופסקה עפ"י הוראת המפעיל (ESC) או COM PORT לא ניתן לפתיחה (WINDOWS).',
    '015' => 'אין התאמה בין המספר שהוקלד לפס המגנטי',
    '016' => 'נתונים נוספים אינם או ישנם בניגוד להגדרות המסוף',
    '017' => 'לא הוקלדו 4 ספרות האחרונות',
    '019' => 'רשומה בקובץ INT_IN קצרה מ- 16 תווים.',
    '020' => 'קובץ קלט (IN_INT) לא קיים.',
    '021' => 'קובץ חסומים (NEG) לא קיים או לא מעודכן - בצע שידור או בקשה לאישור עבור כל עיסקה.',
    '022' => 'אחד מקבצי פרמטרים או ווקטורים לא קיים.',
    '023' => 'קובץ תאריכים (DATA) לא קיים.',
    '024' => 'קובץ אתחול (START) לא קיים.',
    '025' => 'הפרש בימים בקליטת חסומים גדול מדי - בצע שידור או בקשה לאישור עבור כל עיסקה.',
    '026' => 'הפרש דורות בקליטת חסומים גדול מידי - בצע שידור או בקשה לאישור עבור כל עיסקה.',
    '027' => 'כאשר לא הוכנס פס מגנטי כולו הגדר עיסקה כעיסקה טלפונית או כעיסקת חתימה בלבד.',
    '028' => 'מספר מסוף מרכזי לא הוכנס למסוף המוגדר לעבודה כרב ספק.',
    '029' => 'מספר מוטב לא הוכנס למסוף המוגדר לעבודה כרב מוטב.',
    '030' => 'מסוף שאינו מעודכן כרב ספק/רב מוטב והוקלד מס\' ספק/מס\' מוטב.',
    '031' => 'מסוף מעודכן כרב ספק והוקלד גם מס\' מוטב.',
    '032' => 'תנועות ישנות בצע שידור או בקשה לאישור עבור כל עיסקה.',
    '033' => 'כרטיס לא תקין.',
    '034' => 'כרטיס לא רשאי לבצע במסוף זה או אין אישור לעיסקה כזאת.',
    '035' => 'כרטיס לא רשאי לבצע עיסקה עם סוג אשראי זה.',
    '036' => 'פג תוקף.',
    '037' => 'שגיאה בתשלומים-סכום עסקה צריך להיות שווה תשלום ראשון+(תשלום קבוע כפול מס\' תשלומים).',
    '038' => 'לא ניתן לבצע עיסקה מעל תקרה לכרטיס לאשראי חיוב מיידי.',
    '039' => 'סיפרת בקורת לא תקינה.',
    '040' => 'מסוף שמוגדר כרב מוטב הוקלד מס\' ספק.',
    '041' => 'מעל תקרה כאשר קובץ הקלט מכיל 3J או 2J או 1J  (אסור להתקשר).',
    '042' => 'כרטיס חסום בספק  כאשר קובץ הקלט מכיל 3J או 2J  או 1J (אסור להתקשר).',
    '043' => 'אקראית כאשר קובץ הקלט מכיל J1  (אסור להתקשר).',
    '044' => 'מסוף לא רשאי לבקש אישור ללא עיסקה (5J).',
    '045' => 'מסוף לא רשאי לבקש אישור ביוזמת קמעונאי (6J).',
    '046' => 'מסוף חייב לבקש אישור כאשר קובץ הקלט מכיל 3J או 2J או 1J  (אסור להתקשר).',
    '047' => 'חייב להקליד מספר סודי, כאשר קובץ הקלט מכיל J3 או 2J או 1J (אסור להתקשר).',
    '051' => 'מספר רכב לא תקין.',
    '052' => 'מד מרחק  לא הוקלד.',
    '053' => 'מסוף לא מוגדר כתחנת דלק. (הועבר כרטיס דלק או קוד עיסקה לא מתאים).',
    '057' => 'לא הוקלד מספר תעודת זהות.',
    '058' => 'לא הוקלד CVV2',
    '059' => 'לא הוקלדו מספר תעודת הזהות וה – CVV2 .',
    '060' => 'צרוף ABS לא נמצא בהתחלת נתוני קלט בזיכרון.',
    '061' => 'מספר כרטיס לא נמצא או נמצא פעמיים.',
    '062' => 'סוג עיסקה לא תקין.',
    '063' => 'קוד עיסקה לא תקין.',
    '064' => 'סוג אשראי לא תקין.',
    '065' => 'מטבע לא תקין.',
    '066' => 'קיים תשלום ראשון ו/או תשלום קבוע לסוג אשראי שונה מתשלומים.',
    '067' => 'קיים מספר תשלומים לסוג אשראי שאינו דורש זה.',
    '068' => 'לא ניתן להצמיד לדולר או למדד לסוג אשראי שונה מתשלומים.',
    '069' => 'אורך הפס המגנטי קצר מידי.',
    '070' => 'לא מוגדר מכשיר להקשת מספר סודי.',
    '071' => 'חובה להקליד מספר סודי.',
    '072' => 'קכ"ח לא זמין – העבר בקורא מגנטי.',
    '073' => 'חובה להעביר כרטיס בקכ"ח.',
    '074' => 'דחייה – כרטיס נעול.',
    '075' => 'דחייה – פעולה עם קכ"ח לא הסתיימה בזמן הראוי.',
    '076' => 'דחייה – נתונים אשר התקבלו מקכ"ח אינם מוגדרים במערכת.',
    '077' => 'הוקש מספר סודי שגוי.',
    '080' => 'הוכנס "קוד מועדון" לסוג אשראי לא מתאים.',
    '099' => 'לא מצליח לקרוא/ לכתוב/ לפתוח  קובץ TRAN.',
    '101' => 'אין אישור מחברת אשראי לעבודה.',
    '106' => 'למסוף אין אישור לביצוע שאילתא לאשראי חיוב מיידי.',
    '107' => 'סכום העיסקה גדול מידי - חלק במספר העיסקאות.',
    '108' => 'למסוף אין אישור לבצע עסקאות מאולצות.',
    '109' => 'למסוף אין אישור לכרטיס עם קוד השרות 587.',
    '110' => 'למסוף אין אישור לכרטיס חיוב מיידי.',
    '111' => 'למסוף אין אישור לעיסקה בתשלומים.',
    '112' => 'למסוף אין אישור לעיסקה טלפון/ חתימה בלבד בתשלומים.',
    '113' => 'למסוף אין אישור לעיסקה טלפונית.',
    '114' => 'למסוף אין אישור לעיסקה "חתימה בלבד".',
    '115' => 'למסוף אין אישור לעיסקה בדולרים.',
    '116' => 'למסוף אין אישור לעסקת מועדון.',
    '117' => 'למסוף אין אישור לעסקת כוכבים/נקודות/מיילים.',
    '118' => 'למסוף אין אישור לאשראי ישראקרדיט.',
    '119' => 'למסוף אין אישור לאשראי אמקס  קרדיט.',
    '120' => 'למסוף אין אישור להצמדה לדולר.',
    '121' => 'למסוף אין אישור להצמדה למדד.',
    '122' => 'למסוף אין אישור להצמדה למדד לכרטיסי חו"ל.',
    '123' => 'למסוף אין אישור לעסקת כוכבים/נקודות/מיילים לסוג אשראי זה.',
    '124' => 'למסוף אין אישור לאשראי ישרא 36.',
    '125' => 'למסוף איו אישור לאשראי אמקס 36.',
    '126' => 'למסוף אין אישור לקוד מועדון זה.',
    '127' => 'למסוף אין אישור לעסקת חיוב מיידי פרט לכרטיסי חיוב מיידי',
    '128' => 'למסוף אין אישור לקבל כרטיסי ויזה אשר מתחילים ב - 3.',
    '129' => 'למסוף אין אישור לבצע עסקת זכות מעל תקרה.',
    '130' => 'כרטיס  לא רשאי לבצע עסקת מועדון.',
    '131' => 'כרטיס לא רשאי לבצע עסקת כוכבים/נקודות/מיילים.',
    '132' => 'כרטיס לא רשאי לבצע עסקאות בדולרים (רגילות או טלפוניות).',
    '133' => 'כרטיס לא תקף על פי רשימת כרטיסים תקפים של ישראכרט.',
    '134' => 'כרטיס לא תקין עפ”י הגדרת המערכת (VECTOR1 של ישראכרט)- מס\' הספרות בכרטיס- שגוי.',
    '135' => 'כרטיס לא רשאי לבצע עסקאות דולריות עפ”י הגדרת המערכת (VECTOR1 של ישראכרט).',
    '136' => 'הכרטיס שייך לקבוצת כרטיסים אשר אינה רשאית לבצע עסקאות עפ”י הגדרת המערכת',
    '137' => 'קידומת הכרטיס (7 ספרות) לא תקפה עפ”י הגדרת המערכת (21VECTOR של דיינרס).',
    '138' => 'כרטיס לא רשאי לבצע עסקאות בתשלומים על פי רשימת כרטיסים תקפים של ישראכרט.',
    '139' => 'מספר תשלומים גדול מידי על פי רשימת כרטיסים תקפים של ישראכרט.',
    '140' => 'כרטיסי ויזה ודיינרס לא רשאים לבצע עסקאות מועדון בתשלומים.',
    '141' => 'סידרת כרטיסים לא תקפה עפ”י הגדרת המערכת. (VECTOR5 של ישראכרט).',
    '142' => 'קוד שרות לא תקף עפ”י הגדרת המערכת (VECTOR6 של ישראכרט).',
    '143' => 'קידומת הכרטיס (2 ספרות) לא תקפה עפ”י הגדרת המערכת. (VECTOR7  של ישראכרט).',
    '144' => 'קוד שרות לא תקף עפ”י הגדרת המערכת. (VECTOR12 של ויזה).',
    '145' => 'קוד שרות לא תקף עפ”י הגדרת המערכת. (VECTOR13 של ויזה).',
    '146' => 'לכרטיס חיוב מיידי אסור לבצע עסקת זכות.',
    '147' => 'כרטיס לא רשאי לבצע עיסקאות בתשלומים עפ"י וקטור 31  של לאומי קארד.',
    '148' => 'כרטיס לא רשאי לבצע עסקאות טלפוניות וחתימה בלבד עפ"י ווקטור 31 של לאומי קארד.',
    '149' => 'כרטיס אינו רשאי לבצע עיסקאות טלפוניות עפ"י  וקטור 31 של לאומי קארד.',
    '150' => 'אשראי לא מאושר לכרטיסי חיוב מיידי.',
    '151' => 'אשראי לא מאושר לכרטיסי חו"ל.',
    '152' => 'קוד מועדון לא תקין.',
    '153' => 'כרטיס לא רשאי לבצע עסקאות אשראי גמיש (עדיף +30/) עפ"י הגדרת המערכת. (21VECTOR של דיינרס',
    '154' => 'כרטיס לא רשאי לבצע עסקאות חיוב מיידי עפ"י הגדרת המערכת. (VECTOR21 של דיינרס).',
    '155' => 'סכום לתשלום בעסקת קרדיט קטן מידי.',
    '156' => 'מספר תשלומים לעסקת קרדיט לא תקין.',
    '157' => 'תקרה 0 לסוג כרטיס זה בעיסקה עם אשראי רגיל או קרדיט.',
    '158' => 'תקרה 0 לסוג כרטיס זה בעיסקה עם אשראי חיוב מיידי.',
    '159' => 'תקרה 0 לסוג כרטיס זה  בעסקת חיוב מיידי בדולרים.',
    '160' => 'תקרה 0 לסוג כרטיס זה בעיסקה טלפונית.',
    '161' => 'תקרה 0 לסוג כרטיס זה בעסקת זכות.',
    '162' => 'תקרה 0 לסוג כרטיס זה בעסקת תשלומים.',
    '163' => 'כרטיס אמריקן אקספרס אשר הונפק בחו"ל לא רשאי לבצע עסקאות בתשלומים.',
    '164' => 'כרטיסיJCB  רשאי לבצע עסקאות רק באשראי רגיל.',
    '165' => 'סכום בכוכבים/נקודות/מיילים גדול מסכום העיסקה.',
    '166' => 'כרטיס מועדון לא בתחום של המסוף.',
    '167' => 'לא ניתן לבצע עסקת כוכבים/נקודות/מיילים בדולרים.',
    '168' => 'למסוף אין אישור לעיסקה דולרית עם סוג אשראי זה.',
    '169' => 'לא ניתן לבצע עסקת זכות עם אשראי שונה מהרגיל',
    '170' => 'סכום הנחה בכוכבים/נקודות/מיילים גדול מהמותר.',
    '171' => 'לא ניתן לבצע עיסקה מאולצת לכרטיס/אשראי חיוב מיידי.',
    '172' => 'לא ניתן לבטל עיסקה קודמת (עיסקת זכות או מספר כרטיס אינו זהה).',
    '173' => 'עיסקה כפולה.',
    '174' => 'למסוף אין אישור להצמדה למדד לאשראי זה.',
    '175' => 'למסוף אין אישור להצמדה לדולר לאשראי זה.',
    '176' => 'כרטיס אינו תקף עפ”י הגדרת ה מערכת (וקטור 1 של ישראכרט).',
    '177' => 'בתחנות דלק לא ניתן לבצע "שרות עצמי" אלא "שרות עצמי בתחנות דלק".',
    '178' => 'אסור לבצע עיסקת זכות בכוכבים/נקודות/מיילים.',
    '179' => 'אסור לבצע עיסקת זכות בדולר בכרטיס תייר.',
    '180' => 'בכרטיס מועדון לא ניתן לבצע עיסקה טלפונית.',
    '200' => 'שגיאה יישומית.',
    '205' => 'סכום העסקה חסר או אפס.',
    '306' => 'אין תקשורת לפלא קארד.',
    '308' => 'עיסקה כפולה.',
    '404' => 'מסוף שגוי.',
    '500' => 'מסוף מבצע שידור ומעדכן נתונים אנא נסה שנית מאוחר יותר.',
    '501' => 'שם משתמש ו/או סיסמה לא נכונים אנא פנה למחלקת התמיכה.',
    '502' => 'פג תוקף סיסמת המשתמש אנא פנה למחלקת התמיכה.',
    '503' => 'משתמש נעול אנא פנה למחלקת התמיכה.',
    '505' => 'מסוף חסום אנא פנה להנהלת חשבונות.',
    '506' => 'מספר טוקן לא תקין.',
    '507' => 'משתמש לא רשאי לבצע פעולות במסוף זה.',
    '508' => 'מבנה תוקף לא תקין - יש להשתמש במבנה MMYY בלבד.',
    '599' => 'שגיאה כללית אנא פנה למחלקת התמיכה.',
  ];

  /* @var string Payment status code */
  protected $code;

  /* @var string Message locale */
  protected $locale = 'HE';

  /**
   * Payment status constructor
   *
   * @param string $statusCode Payment status code
   * @param string $locale     Message locale, possible values are 'HE'(default), 'EN'
   */
  public function __construct($statusCode, $locale = 'HE') {
    $this->code = $statusCode;
    $this->locale = $locale;
  }

  /**
   * Returns payment status code provided in class constructor.
   *
   * @return string
   */
  public function getCode() {
    return $this->code;
  }

  /**
   * Returns payment status message based on provided status code and locale.
   *
   * @return string|null
   */
  public function getMessage() {
    if (!is_string($this->code)) {
      // invalid status code provided, should be string value
      return null;
    }

    $outputMessage = null;
    $outputLocale = 'HE';
    if (is_string($this->locale) && in_array(strtoupper($this->locale), ['HE', 'EN'], true)) {
      $outputLocale = strtoupper($this->locale);
    }

    switch ($outputLocale) {
      case 'HE':
        // return hebrew when exists, otherwise english
        if (array_key_exists($this->code, PelecardPaymentStatus::MESSAGES_HE)) {
          $outputMessage = PelecardPaymentStatus::MESSAGES_HE[$this->code];
        } elseif (array_key_exists($this->code, PelecardPaymentStatus::MESSAGES_EN)) {
          $outputMessage = PelecardPaymentStatus::MESSAGES_EN[$this->code];
        }
        break;
      case 'EN':
        // return english when exists
        if (array_key_exists($this->code, PelecardPaymentStatus::MESSAGES_EN)) {
          $outputMessage = PelecardPaymentStatus::MESSAGES_EN[$this->code];
        }
        break;
      default:
        // invalid locale provided, return null
        $outputMessage = null;
    }

    return $outputMessage;
  }

  /**
   * Cast class instance to string.
   *
   * @return string
   */
  public function __toString() {
    return (is_string($this->getMessage())) ? $this->getMessage() : '';
  }

}