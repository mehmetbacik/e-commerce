<?php 
ob_start();
session_start();
error_reporting(0);
require_once 'connect.php';
require_once '../production/function.php';
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

/*Admin Login*/
if (isset($_POST['admin_login'])) {
    $user_mail=$_POST['user_mail'];
    $user_password=md5($_POST['user_password']);

    $sql=$db->prepare("SELECT * FROM user WHERE user_mail=:usermail and user_password=:userpassword and user_authority=:userauthority");
	$sql->execute([
        'usermail' => $user_mail, 
        'userpassword' => $user_password,
        'userauthority' => 9
    ]);

    echo $operate=$sql->rowCount();
    
    if ($operate==1) {
        $_SESSION['user_mail']=$user_mail;
        header("Location:../production/index.php");
        exit;
    } else {
        header("Location:../production/login.php?status=false");
        exit;
    }
    
}
/*Admin Login*/

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
        header("Location:../production/setting.php");
        exit;
    } else {
        $_SESSION['status']="error";
        header("Location:../production/setting.php");
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
        header("Location:../production/about.php");
        exit;
    } else {
        $_SESSION['status']="error";
        header("Location:../production/about.php");
        exit;
    }
}
/*About*/

/*User-Edit*/
if (isset($_POST['useredit_save'])) {
    $user_id=$_POST['user_id'];
    $sql=$db->prepare("UPDATE user SET 
        user_name=:user_name,
        user_gsm=:user_gsm,
        user_adress=:user_adress,
        user_country=:user_country,
        user_district=:user_district
        WHERE user_id={$_POST['user_id']}
    ");
    $update=$sql->execute(
        [
            'user_name' => $_POST['user_name'],
            'user_gsm' => $_POST['user_gsm'],
            'user_adress' => $_POST['user_adress'],
            'user_country' => $_POST['user_country'],
            'user_district' => $_POST['user_district']
        ]
    );

    if($update) {
        $_SESSION['status']="success";
        header("Location:../production/user-edit.php?user_id=$user_id&success");
        exit;
    } else {
        $_SESSION['status']="error";
        header("Location:../production/user-edit.php?user_id=$user_id&error");
        exit;
    }
}
/*User-Edit*/

/*User-Remove*/
if ($_GET['userremove']=="approval") {
	$userremove=$db->prepare("DELETE from user where user_id=:id");
	$usercontrol=$userremove->execute(array(
		'id' => $_GET['user_id']
		));
	if ($usercontrol) {
		header("location:../production/user.php?remove=success");
	} else {
		header("location:../production/user.php?remove=error");
	}
}
/*User-Remove*/

/*Menu-Edit*/
if (isset($_POST['menuedit_save'])) {
    $menu_id=$_POST['menu_id'];
    $menu_seourl=seo($_POST['menu_name']);
    $sql=$db->prepare("UPDATE menu SET 
        menu_name=:menu_name,
        menu_detail=:menu_detail,
        menu_url=:menu_url,
        menu_order=:menu_order,
        menu_seourl=:menu_seourl,
        menu_status=:menu_status
        WHERE menu_id={$_POST['menu_id']}
    ");
    $update=$sql->execute(
        [
            'menu_name' => $_POST['menu_name'],
            'menu_detail' => $_POST['menu_detail'],
            'menu_url' => $_POST['menu_url'],
            'menu_order' => $_POST['menu_order'],
            'menu_seourl' => $menu_seourl,
            'menu_status' => $_POST['menu_status']
        ]
    );

    if($update) {
        $_SESSION['status']="success";
        header("Location:../production/menu-edit.php?menu_id=$menu_id&success");
        exit;
    } else {
        $_SESSION['status']="error";
        header("Location:../production/menu-edit.php?menu_id=$menu_id&error");
        exit;
    }
}
/*Menu-Edit*/

/*Menu-Remove*/
if ($_GET['menuremove']=="approval") {
	$menuremove=$db->prepare("DELETE from menu where menu_id=:id");
	$menucontrol=$menuremove->execute(array(
		'id' => $_GET['menu_id']
		));
	if ($menucontrol) {
		header("location:../production/menu.php?remove=success");
	} else {
		header("location:../production/menu.php?remove=error");
	}
}
/*Menu-Remove*/

/*Menu-Add*/
if (isset($_POST['menuadd'])) {
    $menu_seourl=seo($_POST['menu_name']);
    $sql=$db->prepare("INSERT INTO menu SET 
        menu_name=:menu_name,
        menu_detail=:menu_detail,
        menu_url=:menu_url,
        menu_order=:menu_order,
        menu_seourl=:menu_seourl,
        menu_status=:menu_status
    ");
    $insert=$sql->execute(
        [
            'menu_name' => $_POST['menu_name'],
            'menu_detail' => $_POST['menu_detail'],
            'menu_url' => $_POST['menu_url'],
            'menu_order' => $_POST['menu_order'],
            'menu_seourl' => $menu_seourl,
            'menu_status' => $_POST['menu_status']
        ]
    );

    if($insert) {
        header("Location:../production/menu.php?status=success");
        exit;
    } else {
        header("Location:../production/menu.php?status=error");
        exit;
    }
}
/*Menu-Add*/
?>