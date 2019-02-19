<?php
/**
 * @file PelecardPaymentStatus class - allows to get payment status message based on status code
 */
namespace Pelecard;

class PelecardPaymentStatus {

  /* @var array Payment status messages */
  const MESSAGES = [
    '000' => [
      'HE' => 'עסקה תקינה',
      'EN' => 'Permitted transaction.',
    ],
    '001' => [
      'HE' => 'כרטיס חסום',
      'EN' => 'The card is blocked, confiscate it.',
    ],
    '002' => [
      'HE' => 'כרטיס גנוב',
      'EN' => 'The card is stolen, confiscate it.',
    ],
    '003' => [
      'HE' => 'התקשר לחברת האשראי.',
      'EN' => 'Contact the credit company.',
    ],
    '004' => [
      'HE' => 'סירוב.',
      'EN' => 'Refusal by credit company.',
    ],
    '005' => [
      'HE' => 'מזויף החרם כרטיס.',
      'EN' => 'The card is forged, confiscate it.',
    ],
    '006' => [
      'HE' => 'ת.ז. או CVV שגויים.',
      'EN' => 'Incorrect CVV/ID.',
    ],
    '007' => [
      'HE' => 'קוד אישור אינו חוקי- נא לפנות למנהל המערכת.',
      'EN' => 'Incorrect CAVV/ECI/UCAF.',
    ],
    '008' => [
      'HE' => 'תקלה בבניית מפתח גישה לקובץ חסומים.',
      'EN' => 'An error occurred while building access key for blocked card files.',
    ],
    '009' => [
      'HE' => 'תקלת תקשורת, יש לנסות שוב או לפנות למנהל המערכת ולמסור את קוד התשובה',
      'EN' => 'No communication. Please try again or contact System Administration',
    ],
    '010' => [
      'HE' => 'תוכנית הופסקה עפ"י הוראת המפעיל (ESC) או COM PORT לא ניתן לפתיחה (Windows).',
      'EN' => 'The program was stopped by user\'s command (ESC) or COM PORT can\'t be open (Windows)',
    ],
    '011' => [
      'HE' => 'אין לסולק הרשאה לבצע עסקאות מט"ח',
      'EN' => 'The acquirer is not authorized for foreign currency transactions',
    ],
    '012' => [
      'HE' => 'אין אישור למותג במטבע איזו',
      'EN' => 'This card is not permitted for foreign currency transactions',
    ],
    '013' => [
      'HE' => 'אין אישור למסוף לבצע טעינת/פריקת מטיח בכרטיס זה',
      'EN' => 'The terminal is not permitted for foreign currency charge/discharge into this card',
    ],
    '014' => [
      'HE' => 'כרטיס לא נתמך',
      'EN' => 'This card is not Supported.',
    ],
    '015' => [
      'HE' => 'אין התאמה בין המספר שהוקלד לפס המגנטי',
      'EN' => 'Track 2 (Magnetic) does not match the typed data.',
    ],
    '016' => [
      'HE' => 'נתונים נוספים אינם/ישנם בניגוד להגדרות המסוף (שדה Z).',
      'EN' => 'Additional required data was entered/not entered as opposed to terminal Settings (Z field).',
    ],
    '017' => [
      'HE' => 'לא הוקלדו 4 ספרות אחרונות',
      'EN' => 'Last 4 digits were not entered (W field).',
    ],
    '019' => [
      'HE' => 'רשומה בקובץ INT_IN קצרה מ- 16 תווים.',
      'EN' => 'Entry in INT_IN file is shorter than 16 characters.',
    ],
    '020' => [
      'HE' => 'קובץ קלט (INT_IN) לא קיימת.',
      'EN' => 'The input file (INT_IN) does not exist.',
    ],
    '021' => [
      'HE' => 'קובץ חסומים (NEG) לא קיים או לא מעודכן - בצע שידור או בקשה לאישור עבור כל עסקה.',
      'EN' => 'Blocked cards file (NEG) does not exist or has not been updated, transmit or request authorization for each transaction.',
    ],
    '022' => [
      'HE' => 'אחד מקבצי פרמטרים או ווקטורים לא קיים.',
      'EN' => 'One of the parameter files/vectors does not exist.',
    ],
    '023' => [
      'HE' => 'קובץ תאריכים (DATA) לא קיים.',
      'EN' => 'Date file (DATA) does not exist.',
    ],
    '024' => [
      'HE' => 'קובץ אתחול (START) לא קיים.',
      'EN' => 'Format file (START) does not exist.',
    ],
    '025' => [
      'HE' => 'הפרש בימים בקליטת חסומים גדול מדי - בצע שידור או בקשה לאישור עבור כל עסקה.',
      'EN' => 'The difference in days in the blocked cards input is too large, transmit or request authorization for each transaction.',
    ],
    '026' => [
      'HE' => 'הפרש דורות בקליטת חסומים גדול מידי - בצע שידור או בקשה לאישור עבור כל עסקה.',
      'EN' => 'The difference in generations in the blocked cards input is too large, transmit or request authorization for each transaction.',
    ],
    '027' => [
      'HE' => 'לא הוכנס פס מגנטי כולו. הגדר עסקה כעסקה טלפונית או כעסקת חתימה בלבד.',
      'EN' => 'When the magnetic strip is not completely entered, define the transaction as a telephone number or signature only.',
    ],
    '028' => [
      'HE' => 'מספר מסוף מרכזי לא הוכנס לשאילתה במסוף המוגדר לעבודה כרב ספק.',
      'EN' => 'The central terminal number was not entered into the defined main supplier terminal.',
    ],
    '029' => [
      'HE' => 'מספר מוטב לא הוכנס למסוף המוגדר לעבודה כרב מוטב.',
      'EN' => 'The beneficiary number was not entered into the defined main beneficiary terminal.',
    ],
    '030' => [
      'HE' => 'מסוף שאינו מעודכן כרב ספק/רב מוטב והוקלד מספר ספק/מספר מוטב.',
      'EN' => 'The supplier/beneficiary number was entered, however the terminal was not updated as the main supplier/beneficiary.',
    ],
    '031' => [
      'HE' => 'מסוף מעודכן כרב ספק והוקלד גם מספר מוטב.',
      'EN' => 'The beneficiary number was entered, however the terminal was updated as the main supplier.',
    ],
    '032' => [
      'HE' => 'תנועות ישנות בצע שידור או בקשה לאישור עבור כל עסקה.',
      'EN' => 'Old transactions, transmit or request authorization for each transaction.',
    ],
    '033' => [
      'HE' => 'כרטיס לא תקין.',
      'EN' => 'Defective card.',
    ],
    '034' => [
      'HE' => 'כרטיס לא רשאי לבצע במסוף זה או אין אישור לעסקה כזאת.',
      'EN' => 'This card is not permitted for this terminal or is not authorized for this type of transaction.',
    ],
    '035' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקה עם סוג אשראי זה.',
      'EN' => 'This card is not permitted for this transaction or type of credit.',
    ],
    '036' => [
      'HE' => 'כרטיס פג תוקף.',
      'EN' => 'Expired card.',
    ],
    '037' => [
      'HE' => 'שגיאה בתשלומים - סכום עסקה צריך להיות שווה תשלום ראשון +(תשלום קבוע כפול מספר תשלומים).',
      'EN' => 'Installment error, the amount of transactions needs to be equal to: first installment plus fixed installments times number of installments.',
    ],
    '038' => [
      'HE' => 'לא ניתן לבצע עסקה מעל תקרה לכרטיס לאשראי חיוב מיידי.',
      'EN' => 'Unable to execute a debit transaction that is higher than the credit card`s ceiling.',
    ],
    '039' => [
      'HE' => 'סיפרת בקורת לא תקינה.',
      'EN' => 'Incorrect control number.',
    ],
    '040' => [
      'HE' => 'מסוף שמוגדר כרב מוטב הוקלד מספר ספק.',
      'EN' => 'The beneficiary and supplier numbers were entered, however the terminal is defined as main.',
    ],
    '041' => [
      'HE' => 'מעל תקרה כאשר רשומת הקלט מכילה J3 או J2 או J1 (אסור להתקשר).',
      'EN' => 'The transaction`s amount exceeds the ceiling when the input file contains J1, J2 or J3 (contact prohibited).',
    ],
    '042' => [
      'HE' => 'כרטיס חסום בספק כאשר רשומת הקלט מכילה J3 או J2 או J1 (אסור להתקשר).',
      'EN' => 'The card is blocked for the supplier where input file contains J1, J2 or J3 (contact prohibited).',
    ],
    '043' => [
      'HE' => 'אקראית כאשר רשומת הקלט מכילה J1 (אסור להתקשר).',
      'EN' => 'Random where input file contains J1 (contact prohibited).',
    ],
    '044' => [
      'HE' => 'מסוף לא רשאי לבקש אישור ללא עסקה (J5).',
      'EN' => 'The terminal is prohibited from requesting authorization without transaction (J5).',
    ],
    '045' => [
      'HE' => 'מסוף לא רשאי לבקש אישור ביוזמת קמעונאי (J6).',
      'EN' => 'The terminal is prohibited for supplier-initiated authorization request (J6).',
    ],
    '046' => [
      'HE' => 'מסוף חייב לבקש אישור כאשר רשומת הקלט מכילה J3 או J2 או J1 (אסור להתקשר).',
      'EN' => 'The terminal must request authorization where the input file contains J1, J2 or J3 (contact prohibited).',
    ],
    '047' => [
      'HE' => 'חייב להקליד מספר סודי, כאשר רשומת הקלט מכילה J3 או J2 או J1 (אסור להתקשר).',
      'EN' => 'Secret code must be entered where input file contains J1, J2 or J3 (contact prohibited).',
    ],
    '051' => [
      'HE' => 'מספר רכב לא תקין.',
      'EN' => 'Incorrect vehicle number.',
    ],
    '052' => [
      'HE' => 'מד מרחק לא הוקלד.',
      'EN' => 'The number of the distance meter was not entered.',
    ],
    '053' => [
      'HE' => 'מסוף לא מוגדר כתחנת דלק. (הועבר כרטיס דלק או קוד עסקה לא מתאים).',
      'EN' => 'The terminal is not defined as gas station (petrol card or incorrect transaction code was used).',
    ],
    '057' => [
      'HE' => 'לא הוקלד מספר תעודת הזהות',
      'EN' => 'An ID number is required (for Israeli cards only) but was not entered.',
    ],
    '058' => [
      'HE' => 'חייב להקליד CVV.',
      'EN' => 'CVV is required but was not entered.',
    ],
    '059' => [
      'HE' => 'לא הוקלד מספר תעודת הזהות !-CVV .',
      'EN' => 'CVV and ID number are required (for Israeli cards only) but were not entered.',
    ],
    '060' => [
      'HE' => 'צרוף ABS לא נמצא בהתחלת נתוני קלט בזיכרון.',
      'EN' => 'ABS attachment was not found at the beginning of the input data in memory.',
    ],
    '061' => [
      'HE' => 'מספר כרטיס לא נמצא או נמצא פעמיים.',
      'EN' => 'The card number was either not found or found twice.',
    ],
    '062' => [
      'HE' => 'סוג עסקה לא תקין.',
      'EN' => 'Incorrect transaction type.',
    ],
    '063' => [
      'HE' => 'קוד עסקה לא תקין.',
      'EN' => 'Incorrect transaction code.',
    ],
    '064' => [
      'HE' => 'סוג אשראי לא תקין.',
      'EN' => 'Incorrect credit type.',
    ],
    '065' => [
      'HE' => 'מטבע לא תקין.',
      'EN' => 'Incorrect currency.',
    ],
    '066' => [
      'HE' => 'קיים תשלום ראשון ו/או תשלום קבוע לסוג אשראי שונה מתשלומים.',
      'EN' => 'The first installment and/or fixed payment are for non-installment type of credit.',
    ],
    '067' => [
      'HE' => 'קיים מספר תשלומים לסוג אשראי שאינו דורש זה.',
      'EN' => 'Number of installments exist for the type of credit that does not require this.',
    ],
    '068' => [
      'HE' => 'לא ניתן להצמיד לדולר או למדד לסוג אשראי שונה מתשלומים.',
      'EN' => 'Linkage to dollar or index is possible only for installment credit.',
    ],
    '069' => [
      'HE' => 'אורך הפס המגנטי קצר מידי.',
      'EN' => 'The magnetic strip is too short.',
    ],
    '070' => [
      'HE' => 'לא מוגדר מכשיר להקשת מספר סודי.',
      'EN' => 'The PIN code device is not defined.',
    ],
    '071' => [
      'HE' => 'חובה להקליד מספר סודי.',
      'EN' => 'Must enter the PIN code number.',
    ],
    '072' => [
      'HE' => 'קכ"ח (קורא כרטיסים חכם) לא זמין - העבר בקורא מגנטי.',
      'EN' => 'Smart card reader not available - use the magnetic reader.',
    ],
    '073' => [
      'HE' => 'חובה להעביר כרטיס בקכ"ח (קורא כרטיסים חכם).',
      'EN' => 'Must use the Smart card reader.',
    ],
    '074' => [
      'HE' => 'דחייה - כרטיס נעול.',
      'EN' => 'Denied - locked card.',
    ],
    '075' => [
      'HE' => 'דחייה - פעולה עם קכ"ח לא הסתיימה בזמן הראוי.',
      'EN' => 'Denied - Smart card reader action didn\'t end in the correct time.',
    ],
    '076' => [
      'HE' => 'דחייה - נתונים אשר התקבלו מקכ"ח אינם מוגדרים במערכת.',
      'EN' => 'Denied - Data from smart card reader not defined in system.',
    ],
    '077' => [
      'HE' => 'הוקלד מספר סודי שגוי',
      'EN' => 'Incorrect PIN code.',
    ],
    '079' => [
      'HE' => 'מטבע לא קיים בווקטור 59.',
      'EN' => 'Currency does not exist in vector 59.',
    ],
    '080' => [
      'HE' => 'הוכנס "קוד מועדון" לסוג אשראי לא מתאים.',
      'EN' => 'The club code entered does not match the credit type.',
    ],
    '090' => [
      'HE' => 'עסקת ביטול אסורה בכרטיס. יש לבצע עסקת טעינה',
      'EN' => 'Cannot cancel charge transaction. Make charging deal.',
    ],
    '091' => [
      'HE' => 'עסקת ביטול אסורה בכרטיס. יש לבצע עסקת פריקה.',
      'EN' => 'Cannot cancel charge transaction. Make discharge transaction',
    ],
    '092' => [
      'HE' => 'עסקת ביטול אסורה בכרטיס. יש לבצע עסקת זיכוי.',
      'EN' => 'Cannot cancel charge transaction. Please create a credit transaction.',
    ],
    '099' => [
      'HE' => 'לא מצליח לקרוא/ לכתוב/ לפתוח קובץ TRAN.',
      'EN' => 'Unable to read/write/open the TRAN file.',
    ],
    '101' => [
      'HE' => 'אין אישור מחברת אשראי לעבודה.',
      'EN' => 'No authorization from credit company for clearance.',
    ],
    '106' => [
      'HE' => 'למסוף אין אישור לביצוע שאילתא לאשראי חיוב מיידי.',
      'EN' => 'The terminal is not permitted to send queries for immediate debit cards.',
    ],
    '107' => [
      'HE' => 'סכום העסקה גדול מידי - חלק במספר העסקאות.',
      'EN' => 'The transaction amount is too large, divide it into a number of transactions.',
    ],
    '108' => [
      'HE' => 'למסוף אין אישור לבצע עסקאות מאולצות.',
      'EN' => 'The terminal is not authorized to execute forced transactions.',
    ],
    '109' => [
      'HE' => 'למסוף אין אישור לכרטיס עם קוד השרות 587.',
      'EN' => 'The terminal is not authorized for cards with service code 587.',
    ],
    '110' => [
      'HE' => 'למסוף אין אישור לכרטיס חיוב מיידי.',
      'EN' => 'The terminal is not authorized for immediate debit cards.',
    ],
    '111' => [
      'HE' => 'למסוף אין אישור לעסקה בתשלומים.',
      'EN' => 'The terminal is not authorized for installment transactions.',
    ],
    '112' => [
      'HE' => 'למסוף אין אישור לעסקה טלפון/ חתימה בלבד תשלומים.',
      'EN' => 'The terminal is authorized for installment transactions only, not telephone/signature.',
    ],
    '113' => [
      'HE' => 'למסוף אין אישור לעסקה טלפונית.',
      'EN' => 'The terminal is not authorized for telephone transactions.',
    ],
    '114' => [
      'HE' => 'למסוף אין אישור לעסקה "חתימה בלבד".',
      'EN' => 'The terminal is not authorized for signature-only transactions.',
    ],
    '115' => [
      'HE' => 'למסוף אין אישור לעסקאות במטבע זר או עסקה לא מאושרת.',
      'EN' => 'The terminal is not authorized for foreign currency transactions, or transaction is not authorized.',
    ],
    '116' => [
      'HE' => 'למסוף אין אישור לעסקת מועדון.',
      'EN' => 'The terminal is not authorized for club transactions.',
    ],
    '117' => [
      'HE' => 'למסוף אין אישור לעסקת כוכבים/נקודות/מיילים.',
      'EN' => 'The terminal is not authorized for star/point/mile transactions.',
    ],
    '118' => [
      'HE' => 'למסוף אין אישור לאשראי ישראקרדיט.',
      'EN' => 'The terminal is not authorized for Isracredit credit.',
    ],
    '119' => [
      'HE' => 'למסוף אין אישור לאשראי אמקס קרדיט.',
      'EN' => 'The terminal is not authorized for Amex credit.',
    ],
    '120' => [
      'HE' => 'למסוף אין אישור להצמדה לדולר.',
      'EN' => 'The terminal is not authorized for dollar linkage.',
    ],
    '121' => [
      'HE' => 'למסוף אין אישור להצמדה למדד.',
      'EN' => 'The terminal is not authorized for index linkage.',
    ],
    '122' => [
      'HE' => 'למסוף אין אישור להצמדה למדד לכרטיסי חו"ל.',
      'EN' => 'The terminal is not authorized for index linkage with foreign cards.',
    ],
    '123' => [
      'HE' => 'למסוף אין אישור לעסקת כוכבים/נקודות/מיילים לסוג אשראי זה.',
      'EN' => 'The terminal is not authorized for star/point/mile transactions for this type of credit.',
    ],
    '124' => [
      'HE' => 'למסוף אין אישור לאשראי ישרא 36',
      'EN' => 'The terminal is not authorized for Isra 36 credit.',
    ],
    '125' => [
      'HE' => 'למסוף אין אישור לאשראי אמקס 36.',
      'EN' => 'The terminal is not authorized for Amex 36 credit.',
    ],
    '126' => [
      'HE' => 'למסוף אין אישור לקוד מועדון זה.',
      'EN' => 'The terminal is not authorized for this club code.',
    ],
    '127' => [
      'HE' => 'למסוף אין אישור לעסקת חיוב מיידי פרס לכרטיסי חיוב מיידי.',
      'EN' => 'The terminal is not authorized for immediate debit transactions (except for immediate debit cards).',
    ],
    '128' => [
      'HE' => 'למסוף אין אישור לקבל כרסיסי ויזה אשר מתחילים ב - 3.',
      'EN' => 'The terminal is not authorized to accept Visa card staring with 3.',
    ],
    '129' => [
      'HE' => 'למסוף אין אישור לבצע עסקת זכות מעל תקרה.',
      'EN' => 'The terminal is not authorized to execute credit transactions above the ceiling.',
    ],
    '130' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקת מועדון.',
      'EN' => 'The card is not permitted to execute club transactions.',
    ],
    '131' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקת כוכבים/נקודות/מיילים.',
      'EN' => 'The card is not permitted to execute star/point/mile transactions.',
    ],
    '132' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקאות בדולרים (רגילות או טלפוניות).',
      'EN' => 'The card is not permitted to execute dollar transactions (regular or telephone).',
    ],
    '133' => [
      'HE' => 'כרטיס לא תקף על פי רשימת כרטיסים תקפים של ישראכרס.',
      'EN' => 'The card is not valid according to Isracard`s list of valid cards.',
    ],
    '134' => [
      'HE' => 'כרטיס לא תקין עפ”י הגדרת המערכת (VECTOR1 של ישראכרט)- מספר הספרות בכרטיס- שגוי.',
      'EN' => 'Defective card according to system definitions (Isracard VECTOR1), error in the number of figures on the card.',
    ],
    '135' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקאות דולריות עפ”י הגדרת המערכת (VECTOR1 של ישראכרט).',
      'EN' => 'The card is not permitted to execute dollar transactions according to system definitions (Isracard VECTOR1).',
    ],
    '136' => [
      'HE' => 'הכרטיס שייך לקבוצת כרטיסים אשר אינה רשאית לבצע עסקאות עפ”י הגדרת המערכת (VECTOR20 של ויזה).',
      'EN' => 'The card belongs to a group that is not permitted to execute transactions according to system definitions (Visa VECTOR 20).',
    ],
    '137' => [
      'HE' => 'קידומת הכרטיס (7 ספרות) לא תקפה עפ”י הגדרת המערכת (VECTOR21 של דיינרס).',
      'EN' => 'The card`s prefix (7 figures) is invalid according to system definitions (Diners VECTOR21).',
    ],
    '138' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקאות בתשלומים על פי רשימת כרטיסים תקפים של ישראכרט.',
      'EN' => 'The card is not permitted to carry out installment transactions according to Isracard`s list of valid cards.',
    ],
    '139' => [
      'HE' => 'מספר תשלומים גדול מידי על פי רשימת כרטיסים תקפים של ישראכרט.',
      'EN' => 'The number of installments is too large according to Isracard`s list of valid cards.',
    ],
    '140' => [
      'HE' => 'כרטיסי ויזה ודיינרס לא רשאים לבצע עסקאות מועדון בתשלומים.',
      'EN' => 'Visa and Diners cards are not permitted for club installment transactions.',
    ],
    '141' => [
      'HE' => 'סידרת כרטיסים לא תקפה עפ”י הגדרת המערכת. (VECTOR5 של ישראכרט).',
      'EN' => 'Series of cards are not valid according to system definition (Isracard VECTOR5).',
    ],
    '142' => [
      'HE' => 'קוד שרות לא תקף עפ”י הגדרת המערכת (VECTOR6 של ישראכרט).',
      'EN' => 'Invalid service code according to system definitions (Isracard VECTOR6).',
    ],
    '143' => [
      'HE' => 'קידומת הכרטיס (2 ספרות) לא תקפה עפ”י הגדרת המערכת. (VECTOR7 של ישראכרט).',
      'EN' => 'The card`s prefix (2 figures) is invalid according to system definitions (Isracard VECTOR7).',
    ],
    '144' => [
      'HE' => 'קוד שרות לא תקף עפ”י הגדרת המערכת. (VECTOR12 של ויזה).',
      'EN' => 'Invalid service code according to system definitions (Visa VECTOR12).',
    ],
    '145' => [
      'HE' => 'קוד שרות לא תקף עפ”י הגדרת המערכת. (VECTOR13 של ויזה).',
      'EN' => 'Invalid service code according to system definitions (Visa VECTOR13).',
    ],
    '146' => [
      'HE' => 'לכרטיס חיוב מיידי אסור לבצע עסקת זכות.',
      'EN' => 'Immediate debit card is prohibited for executing credit transaction.',
    ],
    '147' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקאות בתשלומים עפ"י וקטור 31 של לאומיקארד.',
      'EN' => 'The card is not permitted to execute installment transactions according to Alpha vector no. 31.',
    ],
    '148' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקאות טלפוניות וחתימה בלבד עפ"י ווקטור 31 של לאומיקארד.',
      'EN' => 'The card is not permitted for telephone and signature-only transactions according to Alpha vector no. 31.',
    ],
    '149' => [
      'HE' => 'כרטיס אינו רשאי לבצע עסקאות טלפוניות עפ"י וקטור 31 של לאומיקארד.',
      'EN' => 'The card is not permitted for telephone transactions according to Alpha vector no. 31.',
    ],
    '150' => [
      'HE' => 'אשראי לא מאושר לכרטיסי חיוב מיידי.',
      'EN' => 'Credit is not approved for immediate debit cards.',
    ],
    '151' => [
      'HE' => 'אשראי לא מאושר לכרטיסי חו"ל.',
      'EN' => 'Credit is not approved for foreign cards.',
    ],
    '152' => [
      'HE' => 'קוד מועדון לא תקין.',
      'EN' => 'Incorrect club code.',
    ],
    '153' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקת אשראי גמיש (עדיף +30/) עפ"י הגדרת המערכת. (VECTOR21 של דיינרס).',
      'EN' => 'The card is not permitted to execute flexible credit transactions (Adif/30+) according to system definitions (Diners VECTOR21).',
    ],
    '154' => [
      'HE' => 'כרטיס לא רשאי לבצע עסקאות חיוב מיידי עפ"י הגדרת המערכת. (VECTOR21 של דיינרס).',
      'EN' => 'The card is not permitted to execute immediate debit transactions according to system definitions (Diners VECTOR21).',
    ],
    '155' => [
      'HE' => 'סכום לתשלום בעסקת קרדיט קטן מידי.',
      'EN' => 'The payment amount is too low for credit transactions.',
    ],
    '156' => [
      'HE' => 'מספר תשלומים לעסקת קרדיט לא תקין.',
      'EN' => 'Incorrect number of installments for credit transaction.',
    ],
    '157' => [
      'HE' => 'תקרה 0 לסוג כרטיס זה בעסקה עם אשראי רגיל או קרדיט.',
      'EN' => 'Zero ceiling for this type of card for regular credit or Credit transaction.',
    ],
    '158' => [
      'HE' => 'תקרה 0 לסוג כרטיס זה בעסקה עם אשראי חיוב מיידי.',
      'EN' => 'Zero ceiling for this type of card for immediate debit credit transaction.',
    ],
    '159' => [
      'HE' => 'תקרה 0 לסוג כרטיס זה בעסקת חיוב מיידי בדולרים.',
      'EN' => 'Zero ceiling for this type of card for immediate debit in dollars.',
    ],
    '160' => [
      'HE' => 'תקרה 0 לסוג כרטיס זה בעסקה טלפונית.',
      'EN' => 'Zero ceiling for this type of card for telephone transaction.',
    ],
    '161' => [
      'HE' => 'תקרה 0 לסוג כרטיס זה בעסקת זכות.',
      'EN' => 'Zero ceiling for this type of card for credit transaction.',
    ],
    '162' => [
      'HE' => 'תקרה 0 לסוג כרטיס זה בעסקת תשלומים.',
      'EN' => 'Zero ceiling for this type of card for installment transaction.',
    ],
    '163' => [
      'HE' => 'כרטיס אמריקן אקספרס אשר הונפק בחוייל לא רשאי לבצע עסקאות בתשלומים.',
      'EN' => 'American Express card issued abroad not permitted for instalments transaction.',
    ],
    '164' => [
      'HE' => 'כרטיסי JCB רשאי לבצע עסקאות רק באשראי רגיל.',
      'EN' => 'JCB cards are only permitted to carry out regular credit transactions.',
    ],
    '165' => [
      'HE' => 'סכום בכוכבים/נקודות/מיילים גדול מסכום העסקה.',
      'EN' => 'The amount in stars/points/miles is higher than the transaction amount.',
    ],
    '166' => [
      'HE' => 'כרטיס מועדון לא בתחום של המסוף.',
      'EN' => 'The club card is not within terminal range.',
    ],
    '167' => [
      'HE' => 'לא ניתן לבצע עסקת כוכבים/נקודות/מיילים בדולרים.',
      'EN' => 'Star/point/mile transactions cannot be executed.',
    ],
    '168' => [
      'HE' => 'למסוף אין אישור לעסקה דולרית עם סוג אשראי זה.',
      'EN' => 'Dollar transactions cannot be executed for this type of card.',
    ],
    '169' => [
      'HE' => 'לא ניתן לבצע עסקת זכות עם אשראי שונה מ"רגיל"',
      'EN' => 'Credit transactions cannot be executed with other than regular credit.',
    ],
    '170' => [
      'HE' => 'סכום הנחה בכוכבים/נקודות/מיילים גדול מהמותר.',
      'EN' => 'Amount of discount on stars/points/miles is higher than the permitted.',
    ],
    '171' => [
      'HE' => 'לא ניתן לבצע עסקה מאולצת לכרטיס/אשראי חיוב מיידי.',
      'EN' => 'Forced transactions cannot be executed with credit/immediate debit card.',
    ],
    '172' => [
      'HE' => 'לא ניתן לבטל עסקה קודמת (עסקת זכות או מספר כרטיס אינו זהה).',
      'EN' => 'The previous transaction cannot be cancelled (credit transaction or card number are not identical).',
    ],
    '173' => [
      'HE' => 'עסקה כפולה.',
      'EN' => 'Double transaction.',
    ],
    '174' => [
      'HE' => 'למסוף אין אישור להצמדה למדד לאשראי זה.',
      'EN' => 'The terminal is not permitted for index linkage of this type of credit.',
    ],
    '175' => [
      'HE' => 'למסוף אין אישור להצמדה לדולר לאשראי זה.',
      'EN' => 'The terminal is not permitted for dollar linkage of this type of credit.',
    ],
    '176' => [
      'HE' => 'כרטיס אינו תקף עפ”י הגדרת ה מערכת (וקטור 1 של ישראכרט).',
      'EN' => 'The card is invalid according to system definitions (Isracard VECTOR1).',
    ],
    '177' => [
      'HE' => 'בתחנות דלק לא ניתן לבצע "שרות עצמי" אלא "שרות עצמי בתחנות דלק".',
      'EN' => 'Unable to execute the self-service transaction if the gas station does not have self service.',
    ],
    '178' => [
      'HE' => 'אסור לבצע עסקת זכות בכוכבים/נקודות/מיילים.',
      'EN' => 'Credit transactions are forbidden with stars/points/miles.',
    ],
    '179' => [
      'HE' => 'אסור לבצע עסקת זכות בדולר בכרטיס תייר.',
      'EN' => 'Dollar credit transactions are forbidden on tourist cards.',
    ],
    '180' => [
      'HE' => 'בכרטיס מועדון לא ניתן לבצע עסקה טלפונית.',
      'EN' => 'Phone transactions are not permitted on Club cards.',
    ],
    '200' => [
      'HE' => 'שגיאה יישומית',
      'EN' => 'Application error.',
    ],
    '201' => [
      'HE' => 'תקלה בקבלת נתונים מוצפנים.',
      'EN' => 'Error receiving encrypted data',
    ],
    '205' => [
      'HE' => 'סכום העסקה חסר או אפס.',
      'EN' => 'Transaction amount missing or zero.',
    ],
    '301' => [
      'HE' => 'עבר זמן השהייה המותר בדף הסליקה.',
      'EN' => null,
    ],
    '302' => [
      'HE' => 'התשלום בוצע אך אתר העסק לא זמין לקבלת התשובה',
      'EN' => null,
    ],
    '303' => [
      'HE' => 'אתר העסק לא זמין',
      'EN' => null,
    ],
    '306' => [
      'HE' => 'אין תקשורת לפלאקארד.',
      'EN' => 'No communication to Pelecard.',
    ],
    '308' => [
      'HE' => 'עסקה כפולה.',
      'EN' => 'Doubled transaction.',
    ],
    '404' => [
      'HE' => 'מספר מסוף לא קיים.',
      'EN' => 'Terminal number does not exist.',
    ],
    '500' => [
      'HE' => 'מסוף מבצע שידור ו/או מעדכן נתונים. אנא נסה שנית מאוחר יותר.',
      'EN' => 'Terminal executes broadcast and/or updating data. Please try again later.',
    ],
    '501' => [
      'HE' => 'שם משתמש ו/או סיסמה לא נכונים. אנא פנה למחלקת תמיכה.',
      'EN' => 'User name and/or password not correct. Please call support team.',
    ],
    '502' => [
      'HE' => 'פג תוקף סיסמת משתמש. אנא פנה למחלקת תמיכה.',
      'EN' => 'User password has expired. Please contact support team.',
    ],
    '503' => [
      'HE' => 'משתמש נעול. אנא פנה למחלקת תמיכה.',
      'EN' => 'Locked user. Please contact support team.',
    ],
    '505' => [
      'HE' => 'מסוף חסום. אנא פנה להנהלת חשבונות.',
      'EN' => 'Blocked terminal. Please contact account team.',
    ],
    '506' => [
      'HE' => 'מספר טוקן לא תקין.',
      'EN' => 'Token number abnormal.',
    ],
    '507' => [
      'HE' => 'משתמש לא רשאי לבצע פעולות במסוף זה.',
      'EN' => 'User is not authorized in this terminal.',
    ],
    '508' => [
      'HE' => 'מבנה תוקף לא תקין. יש להשתמש במבנה MMYY בלבד.',
      'EN' => 'Validity structure invalid. Use MMYY structure only.',
    ],
    '509' => [
      'HE' => 'גישה לאימות תעודת אבטחה חסומה. אנא פנה למחלקת התמיכה.',
      'EN' => 'SSL verifying access is blocked. Please contact support team.',
    ],
    '510' => [
      'HE' => 'לא קיים נתונים.',
      'EN' => 'Data not exist.',
    ],
    '555' => [
      'HE' => 'לקוח לחץ על כפתור ביטול בדף התשלום',
      'EN' => null,
    ],
    '597' => [
      'HE' => 'שגיאה כללית. אנא פנה למחלקת התמיכה.',
      'EN' => 'General error. Please contact support team.',
    ],
    '598' => [
      'HE' => 'ערכים נחוצים חסרים/שגויים.',
      'EN' => 'Necessary values are blocked/wrong.',
    ],
    '599' => [
      'HE' => 'שגיאה כללית. חזור שוב על הפעולה.',
      'EN' => 'General error. Repeat action.',
    ],
    '800' => [
      'HE' => 'שגיאה כללית - UPAY',
      'EN' => null,
    ],
    '801' => [
      'HE' => 'משתמש איננו משתמש UPAY',
      'EN' => null,
    ],
    '802' => [
      'HE' => 'שגיאה בפרטי תשלום ב- UPAY',
      'EN' => null,
    ],
    '803' => [
      'HE' => 'סוג תשלום אינו נתמך ) UPAY )',
      'EN' => null,
    ],
    '804' => [
      'HE' => 'סוג טרנזאקציה לא נתמך ) UPAY )',
      'EN' => null,
    ],
    '805' => [
      'HE' => 'חסרים פרטי משתמש הכרחיים של UPAY',
      'EN' => null,
    ],
    '806' => [
      'HE' => 'העסקה אינה עסקת J4',
      'EN' => null,
    ],
    '999' => [
      'HE' => 'ערכים נחוצים חסרים לעסקת תשלומים.',
      'EN' => 'Necessary values missing to complete installments transaction.',
    ],
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
    if (!is_string($this->code) || !array_key_exists($this->code, PelecardPaymentStatus::MESSAGES)) {
      // invalid status code provided, should be string value
      return null;
    }

    $outputMessage = null;
    $outputLocale = 'HE';
    $messageHe = PelecardPaymentStatus::MESSAGES[$this->code]['HE'];
    $messageEn = PelecardPaymentStatus::MESSAGES[$this->code]['EN'];
    if (is_string($this->locale) && in_array(strtoupper($this->locale), ['HE', 'EN'], true)) {
      $outputLocale = strtoupper($this->locale);
    }

    switch ($outputLocale) {
      case 'HE':
        // return hebrew when exists, otherwise english
        if (!empty($messageHe)) {
          $outputMessage = $messageHe;
        } elseif (!empty($messageEn)) {
          $outputMessage = $messageEn;
        }
        break;
      case 'EN':
        // return english when exists
        if (!empty($messageEn)) {
          $outputMessage = $messageEn;
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