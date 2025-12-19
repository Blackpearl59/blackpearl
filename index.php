<?php
/**
 * WAF Test Web - Single File
 * Purpose: Test WAF detection (XSS, SQLi, Command Injection, LFI)
 * Use for LAB / TEST environment only
 */

$action = $_GET['action'] ?? '';
$value  = $_GET['value'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>WAF Test Web</title>
</head>
<body>

<h1>WAF Test Web (Single PHP File)</h1>

<h2>Test Menu</h2>
<ul>
    <li><a href="?action=xss&value=test">XSS Test</a></li>
    <li><a href="?action=sqli&value=1">SQL Injection Test</a></li>
    <li><a href="?action=cmd&value=whoami">Command Injection Test</a></li>
    <li><a href="?action=lfi&value=/etc/passwd">Path Traversal / LFI Test</a></li>
</ul>

<hr>

<?php
if ($action === 'xss') {
    echo "<h3>XSS Test</h3>";
    echo "<p>Payload Output:</p>";
    echo $value; // intentionally vulnerable
}

elseif ($action === 'sqli') {
    echo "<h3>SQL Injection Test</h3>";
    echo "<pre>";
    echo "SELECT * FROM users WHERE id = $value;";
    echo "</pre>";
}

elseif ($action === 'cmd') {
    echo "<h3>Command Injection Test</h3>";
    echo "<pre>";
    system($value); // intentionally vulnerable
    echo "</pre>";
}

elseif ($action === 'lfi') {
    echo "<h3>Path Traversal / LFI Test</h3>";
    echo "<pre>";
    @readfile($value); // intentionally vulnerable
    echo "</pre>";
}

else {
    echo "<p>Select a test from the menu above.</p>";
}
?>

</body>
</html>
