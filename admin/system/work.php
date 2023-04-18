<?php 
session_start();
error_reporting(0);
require_once 'connect.php';
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

/*Setting*/
if (isset($_POST['setting_save'])) {
    $sql=$db->prepare("UPDATE setting SET 
        setting_title=:setting_title,
        setting_description=:setting_description,
        setting_keywords=:setting_keywords,
        setting_author=:setting_author,
        setting_tel=:setting_tel,
        setting_gsm=:setting_gsm,
        setting_fax=:setting_fax,
        setting_mail=:setting_mail,
        setting_district=:setting_district,
        setting_country=:setting_country,
        setting_adress=:setting_adress,
        setting_time=:setting_time,
        setting_maps=:setting_maps,
        setting_analystic=:setting_analystic,
        setting_desk=:setting_desk,
        setting_facebook=:setting_facebook,
        setting_twitter=:setting_twitter,
        setting_google=:setting_google,
        setting_youtube=:setting_youtube,
        setting_smtphost=:setting_smtphost,
        setting_smtppassword=:setting_smtppassword,
        setting_smtpport=:setting_smtpport
        WHERE setting_id=1
    ");
    $update=$sql->execute(
        [
            'setting_title' => $_POST['setting_title'],
            'setting_description' => $_POST['setting_description'],
            'setting_keywords' => $_POST['setting_keywords'],
            'setting_author' => $_POST['setting_author'],
            'setting_tel' => $_POST['setting_tel'],
            'setting_gsm' => $_POST['setting_gsm'],
            'setting_fax' => $_POST['setting_fax'],
            'setting_mail' => $_POST['setting_mail'],
            'setting_district' => $_POST['setting_district'],
            'setting_country' => $_POST['setting_country'],
            'setting_adress' => $_POST['setting_adress'],
            'setting_time' => $_POST['setting_time'],
            'setting_maps' => $_POST['setting_maps'],
            'setting_analystic' => $_POST['setting_analystic'],
            'setting_desk' => $_POST['setting_desk'],
            'setting_facebook' => $_POST['setting_facebook'],
            'setting_twitter' => $_POST['setting_twitter'],
            'setting_google' => $_POST['setting_google'],
            'setting_youtube' => $_POST['setting_youtube'],
            'setting_smtphost' => $_POST['setting_smtphost'],
            'setting_smtppassword' => $_POST['setting_smtppassword'],
            'setting_smtpport' => $_POST['setting_smtpport']
        ]
    );

    if($update) {
        $_SESSION['status']="success";
        Header("Location:../production/setting.php");
        exit;
    } else {
        $_SESSION['status']="error";
        Header("Location:../production/setting.php");
        exit;
    }
}
/*Setting*/

/*About*/
if (isset($_POST['about_save'])) {
    $sql=$db->prepare("UPDATE about SET 
        about_title=:about_title,
        about_content=:about_content,
        about_video=:about_video,
        about_vision=:about_vision,
        about_mission=:about_mission
        WHERE about_id=1
    ");
    $update=$sql->execute(
        [
            'about_title' => $_POST['about_title'],
            'about_content' => $_POST['about_content'],
            'about_video' => $_POST['about_video'],
            'about_vision' => $_POST['about_vision'],
            'about_mission' => $_POST['about_mission']
        ]
    );

    if($update) {
        $_SESSION['status']="success";
        Header("Location:../production/about.php");
        exit;
    } else {
        $_SESSION['status']="error";
        Header("Location:../production/about.php");
        exit;
    }
}
/*About*/
?>