<?php

/*
You must manually deploy dbconfig.php - it is not under source control for security reasons.

It must define:

$DBCONFIG_DBNAME
$DBCONFIG_USER
$DBCONFIG_PWD
$DBCONFIG_HOST

see dbconfig.php.example
*/

error_reporting(E_ERROR | E_PARSE); // Only report the worst

require_once "dbconfig.php";

header("Content-Type: application/json; charset=utf-8");

$RC = 200;

// HCaptcha
$SITEKEY = "81faee20-2911-41cd-8b4a-71f45b932b8c";
$SECRETKEY = "0x1b0F7bC061c9a0516E72cC31c787ee2784796252";
// Local Globals, change as needed
$EMAILTO = "info0825@northtexasaikido.com";
$EMAILTESTING = "testing@dev.northtexasaikido.com"; // for testing
$EMAILFROM = "North Texas Aikido <noreply@northtexasaikido.com>";
$LOGOURI =
    "https://northtexasaikido.com/warehouse/images/nta-mon-2020-color.png";

function simpleHumanity()
{
    // Is the "I am Human?" box checked?
    // humanaHVtYW4K
    if ($_POST["humanaHVtYW4K"] != "humanaHVtYW4K") {
        throw new Exception("simple humanity test failed");
    }
    error_log("submitContact: simpleHumanity OK");
}

function humanity()
{
    global $SITEKEY, $SECRETKEY;
    $VERIFY_URL = "https://hcaptcha.com/siteverify";
    # Retrieve token from post data with key 'h-captcha-response'.
    $token = $_POST["h-captcha-response"];

    // Build payload with secret key and token
    $data = [
        "secret" => $SECRETKEY,
        "sitekey" => $SITEKEY,
        "response" => $token,
        "remoteip" => $_SERVER["REMOTE_ADDR"],
    ];

    // Initialize cURL request
    // Make POST request with data payload to hCaptcha API endpoint
    $curlConfig = [
        CURLOPT_URL => $VERIFY_URL,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $data,
    ];
    $ch = curl_init();
    curl_setopt_array($ch, $curlConfig);
    $response = curl_exec($ch);
    curl_close($ch);
    // Parse JSON from response. Check for success or error codes
    $responseData = json_decode($response);
    error_log("<== " . json_encode($responseData));
    // If reCAPTCHA response is INvalid - throw Exception
    if (!$responseData->success) {
        throw new Exception("hcaptcha failed: " . $response);
    }
    error_log("submitContact: humanity [" . $responseData->success . "] OK");
    // A-OK
}

function buildMessage()
{
    global $LOGOURI, $EMAILTO, $EMAILFROM;
    $message = "";
    if (!isset($_POST["namebmFtZQo="])) {
        throw new Exception("name not set - check hash agreement bmFtZQo=");
    }
    if (!isset($_POST["emailZW1haWwK"])) {
        throw new Exception("email not set - check hash agreement ZW1haWwK");
    }
    if (!isset($_POST["phonecGhvbmUK"])) {
        throw new Exception("phone not set - check hash agreement cGhvbmUK");
    }
    if (!isset($_POST["commentY29tbWVudAo="])) {
        throw new Exception(
            "comment not set - check hash agreement Y29tbWVudAo="
        );
    }

    //$pathToMon = "";

    //$message .= "<h2>Inquiry from " . filter_input(INPUT_POST, 'namebmFtZQo=', FILTER_SANITIZE_STRING) . "</h2>\r\n";
    $message .=
        "<div style='border-radius: 5px; background-color: rgba(89,25,2, 0.1); padding: 1em;'>";
    $message .= filter_input(
        INPUT_POST,
        "commentY29tbWVudAo=",
        FILTER_SANITIZE_STRING
    );
    $message .= "</div>\r\n";
    $message .= "<h3>Contact Information</h3>\n";
    $message .=
        "<p><strong>Name:</strong> " .
        filter_input(INPUT_POST, "namebmFtZQo=", FILTER_SANITIZE_STRING) .
        "<br />\r\n";
    $message .=
        "<p><strong>Email:</strong> " .
        filter_input(INPUT_POST, "emailZW1haWwK", FILTER_SANITIZE_EMAIL) .
        "<br />\r\n";
    $message .=
        "<p><strong>Phone:</strong> " .
        filter_input(INPUT_POST, "phonecGhvbmUK", FILTER_SANITIZE_STRING) .
        "<br />\r\n";
    $message .=
        "<div style='text-align: center; margin-left: auto; margin-right: auto; width: 100%;'>";
    $message .= "<img src='" . $LOGOURI . "' style='width:10%' /></div>\r\n";

    return $message;
}

function sendEmailMessage()
{
    global $LOGOURI, $EMAILTO, $EMAILFROM, $EMAILTESTING;
    $message = buildMessage();
    $to = $EMAILTO;
    $name = filter_input(INPUT_POST, "namebmFtZQo=", FILTER_SANITIZE_STRING);
    if (strtolower($name) == "_test_") {
        $to = $EMAILTESTING;
    }
    $subject = "[NTA] Inquiry from " . $name;
    $header = "From: " . $EMAILFROM . "\r\n";
    //$header .= "Cc:afgh@somedomain.com \r\n";
    $header .=
        "Reply-to: " .
        filter_input(INPUT_POST, "emailZW1haWwK", FILTER_SANITIZE_EMAIL) .
        "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail($to, $subject, $message, $header);
    if (!$retval) {
        throw new Exception("Message could not be sent.");
    }
    error_log("submitContact: OK email message");
}

function recordInDatabase()
{
    global $DBCONFIG_DBNAME, $DBCONFIG_USER, $DBCONFIG_PWD, $DBCONFIG_HOST;
    $conn = new mysqli(
        $DBCONFIG_HOST,
        $DBCONFIG_USER,
        $DBCONFIG_PWD,
        $DBCONFIG_DBNAME
    );
    // Check connection
    if ($conn->connect_error) {
        throw new Exception($conn->connect_error);
    }
    /* activate reporting */
    $driver = new mysqli_driver();
    $driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

    $sql = "insert into nta_contacts (name, email, phone) values (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sss",
        $_POST["namebmFtZQo="],
        $_POST["emailZW1haWwK"],
        $_POST["phonecGhvbmUK"]
    );
    $stmt->execute();
    $stmt->close();
    $conn->close();
    error_log("submitContact: OK database record");
}

try {
    // Honey potty
    $poohname = isset($_POST["name"]) ? $_POST["name"] : "";
    $poohemail = isset($_POST["email"]) ? $_POST["email"] : "";
    if ($poohname == "" && $poohemail == "") {
        // Honey pots were not set. Make sure the rest of the form is valid.
        // Here are the hashes:
        // Base64
        // email: ZW1haWwK
        // name: bmFtZQo=
        // phone: cGhvbmUK
        // comment: Y29tbWVudAo= -->
        error_log("submitContact POST: ");
        error_log(print_r($_POST, true));

        if (!isset($_POST["namebmFtZQo="])) {
            throw new Exception("name not set - check hash agreement bmFtZQo=");
        }
        if (!isset($_POST["emailZW1haWwK"])) {
            throw new Exception(
                "email not set - check hash agreement ZW1haWwK"
            );
        }
        if (!isset($_POST["phonecGhvbmUK"])) {
            throw new Exception(
                "phone not set - check hash agreement cGhvbmUK"
            );
        }
        if (!isset($_POST["commentY29tbWVudAo="])) {
            throw new Exception(
                "comment not set - check hash agreement Y29tbWVudAo="
            );
        }

        //humanity();
        simpleHumanity();

        recordInDatabase();
        sendEmailMessage();

        echo json_encode(["SUCCESS" => 200]);
    } else {
        error_log(
            "submitContact: Pooh-bear came knocking, name: " .
                $poohname .
                "; email: " .
                $poohemail .
                " [" .
                $_SERVER["REMOTE_ADDR"] .
                "]"
        );
    }
} catch (Exception $e) {
    error_log("submitContact error: " . $e->getMessage());
    $RC = 500;
} finally {
    error_log("<<" . $RC);
    http_response_code($RC);
}

?>
