<?php 

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (isset($_POST['setting_save'])) {
    echo "Form connect";
    exit;
}
    echo "Form False";
?>