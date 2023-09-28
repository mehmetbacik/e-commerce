<?php 
ob_start();
session_start();
error_reporting(0);
require_once 'connect.php';
require_once '../production/function.php';

/*User-Save*/
if (isset($_POST['usersave'])) { 
    $user_name=htmlspecialchars($_POST['user_name']);
    //$user_name=strip_tags($_POST['user_name']); /TagsRemove/
    $user_mail=htmlspecialchars($_POST['user_mail']);
    $user_passwordone=htmlspecialchars($_POST['user_passwordone']);
    $user_passwordtwo=htmlspecialchars($_POST['user_passwordtwo']);

    if ($user_passwordone==$user_passwordtwo) {
        if (strlen($user_passwordone)>=6) {
			$usercontrol=$db->prepare("SELECT * FROM user WHERE user_mail=:mail");
			$usercontrol->execute(
                [
                    'mail' => $user_mail
                ]
			);

			$say=$usercontrol->rowCount();

			if ($say==0) {
				$password=md5($user_passwordone);
				$user_authority=1;

				$usersave=$db->prepare("INSERT INTO user SET
					user_name=:user_name,
					user_mail=:user_mail,
					user_password=:user_password,
					user_authority=:user_authority
				");
				$insert=$usersave->execute(
                    [
                        'user_name' => $user_name,
                        'user_mail' => $user_mail,
                        'user_password' => $password,
                        'user_authority' => $user_authority
                    ]
                );

				if ($insert) {
					header("location:../../index.php?status=loginsuccess");
                    exit;
				} else {
					header("location:../../register.php?status=unsuccessful");
                    exit;
				}
			} else {
				header("location:../../register.php?status=duplication");
                exit;
            }
        } else {
            header("location:../../register.php?status=missingpassword");
            exit;
        }
    } else {
        header("location:../../register.php?status=differentpassword");
        exit;
    }
}
/*User-Save*/

/*User-Customer-Update*/
if (isset($_POST['usercustomer_update'])) {
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
        header("Location:../../account.php?user_id=$user_id&success");
        exit;
    } else {
        $_SESSION['status']="error";
        header("Location:../../account.php?user_id=$user_id&error");
        exit;
    }
}
/*User-Customer-Update*/

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

/*User Login*/
if (isset($_POST['userlogin'])) {

	echo $user_mail=htmlspecialchars($_POST['user_mail']); 
	echo $user_password=md5($_POST['user_password']); 

	$usercontrol=$db->prepare("SELECT * FROM user WHERE user_mail=:mail and user_authority=:authority and user_password=:password and user_status=:status");
	$usercontrol->execute(
        [
            'mail' => $user_mail,
            'authority' => 1,
            'password' => $user_password,
            'status' => 1
        ]
		);

	$say=$usercontrol->rowCount();

	if ($say==1) {
		echo $_SESSION['usercustomer_mail']=$user_mail;
		header("Location:../../");
		exit;
	} else {
		header("Location:../../?status=errorlogin");
	}
}
/*User Login*/

/*Slider Add*/
if (isset($_POST['slideradd'])) {
    
	$uploads_dir = '../../images/slider';
	@$tmp_name = $_FILES['slider_imgurl']["tmp_name"];
	@$name = $_FILES['slider_imgurl']["name"];
	//Unique Image Name
	$uniquenumber1=rand(20000,32000);
	$uniquenumber2=rand(20000,32000);
	$uniquenumber3=rand(20000,32000);
	$uniquenumber4=rand(20000,32000);	
	$uniquename=$uniquenumber1.$uniquenumber2.$uniquenumber3.$uniquenumber4;
	$refimgurl=substr($uploads_dir, 6)."/".$uniquename.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$uniquename$name");

	$save=$db->prepare("INSERT INTO slider SET
		slider_name=:slider_name,
		slider_order=:slider_order,
		slider_link=:slider_link,
		slider_imgurl=:slider_imgurl
		");
	$insert=$save->execute(array(
		'slider_name' => $_POST['slider_name'],
		'slider_order' => $_POST['slider_order'],
		'slider_link' => $_POST['slider_link'],
		'slider_imgurl' => $refimgurl
		));

	if ($insert) {
		header("Location:../production/slider.php?status=success");
        exit;
	} else {
	    header("Location:../production/slider.php?status=error");
        exit;
	}
}
/*Slider Add*/

/*Slider Edit*/
if (isset($_POST['slideredit'])) {
	if($_FILES['slider_imgurl']["size"] > 0)  { 
		$uploads_dir = '../../images/slider';
		@$tmp_name = $_FILES['slider_imgurl']["tmp_name"];
		@$name = $_FILES['slider_imgurl']["name"];
        //Unique Image Name
        $uniquenumber1=rand(20000,32000);
        $uniquenumber2=rand(20000,32000);
        $uniquenumber3=rand(20000,32000);
        $uniquenumber4=rand(20000,32000);	
        $uniquename=$uniquenumber1.$uniquenumber2.$uniquenumber3.$uniquenumber4;
        $refimgurl=substr($uploads_dir, 6)."/".$uniquename.$name;
        @move_uploaded_file($tmp_name, "$uploads_dir/$uniquename$name");

		$edit=$db->prepare("UPDATE slider SET
        	slider_name=:slider_name,
            slider_order=:slider_order,
            slider_link=:slider_link,
            slider_status=:slider_status,
            slider_imgurl=:slider_imgurl
			WHERE slider_id={$_POST['slider_id']}");
		$update=$edit->execute(array(
			'slider_name' => $_POST['slider_name'],
			'slider_order' => $_POST['slider_order'],
			'slider_link' => $_POST['slider_link'],
			'slider_status' => $_POST['slider_status'],
			'slider_imgurl' => $refimgurl,
		    ));
	
		$slider_id=$_POST['slider_id'];
		if ($update) {
			$imgremoveunlink=$_POST['slider_imgurl'];
			unlink("../../$imgremoveunlink");
			header("Location:../production/slider-edit.php?slider_id=$slider_id&status=success");
            exit;
		} else {
			header("Location:../production/slider-edit.php?status=error");
            exit;
		}

	} else {

		$edit=$db->prepare("UPDATE slider SET
        	slider_name=:slider_name,
            slider_order=:slider_order,
            slider_link=:slider_link,
            slider_status=:slider_status	
			WHERE slider_id={$_POST['slider_id']}");
		$update=$edit->execute(array(
			'slider_name' => $_POST['slider_name'],
			'slider_order' => $_POST['slider_order'],
			'slider_link' => $_POST['slider_link'],
			'slider_status' => $_POST['slider_status']
			));

		$slider_id=$_POST['slider_id'];

		if ($update) {
			header("Location:../production/slider-edit.php?slider_id=$slider_id&status=success");
            exit;
		} else {
			header("Location:../production/slider-edit.php?status=error");
            exit;
		}
	}
}
/*Slider Edit*/

/*Slider Remove*/
if ($_GET['sliderremove']=="approval") {

    commandcontrol();
	
	$remove=$db->prepare("DELETE from slider where slider_id=:slider_id");
	$control=$remove->execute(
        [
            'slider_id' => $_GET['slider_id']
        ]
    );

	if ($control) {
		$imgremoveunlink=$_GET['slider_imgurl'];
		unlink("../../$imgremoveunlink");
		header("Location:../production/slider.php?remove=success");
        exit;
	} else {
		header("Location:../production/slider.php?remove=error");
        exit;
	}

}
/*Slider Remove*/

/*Logo Edit*/
if (isset($_POST['logoedit'])) {

    if ($_FILES['setting_logo']['size']>1048576) {
        echo "File size too big";
		header("Location:../production/setting.php?status=bigsize");
        exit;
    }

    $authorized_extensions=array('jpg','png','gif','svg','webp');
    $ext=strtolower(substr($_FILES['setting_logo']["name"],strpos($_FILES['setting_logo']["name"],'.')+1));
    
    if (in_array($ext, $authorized_extensions)=== false) {
        echo "Unaccepted extension";
		header("Location:../production/setting.php?status=unaccepted");
        exit;
    }

	$uploads_dir = '../../images';
	@$tmp_name = $_FILES['setting_logo']["tmp_name"];
	@$name = $_FILES['setting_logo']["name"];
	$uniquenumber4=rand(20000,32000);
	$refimgurl=substr($uploads_dir, 6)."/".$uniquenumber4.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$uniquenumber4$name");

	$edit=$db->prepare("UPDATE setting SET
		setting_logo=:logo
		WHERE setting_id=1");
	$update=$edit->execute(array(
		'logo' => $refimgurl
		));
	if ($update) {
		$imgremoveunlink=$_POST['old_url'];
		unlink("../../$imgremoveunlink");
        
        $_SESSION['status']="success";
		header("Location:../production/setting.php");
        exit;
	} else {
        $_SESSION['status']="error";
		header("Location:../production/setting.php");
        exit;
	}
}
/*Logo Edit*/

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
    commandcontrol();
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
    commandcontrol();
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

/*Category-Edit*/
if (isset($_POST['categoryedit_save'])) {
    $category_id=$_POST['category_id'];
    $category_seourl=seo($_POST['category_name']);
    $sql=$db->prepare("UPDATE categories SET 
        category_name=:name,
        category_status=:status,
        category_seourl=:seourl,
        category_order=:order
        WHERE category_id={$_POST['category_id']}
    ");
    $update=$sql->execute(
        [
            'name' => $_POST['category_name'],
            'status' => $_POST['category_status'],
            'seourl' => $category_seourl,
            'order' => $_POST['category_order']
        ]
    );

    if($update) {
        $_SESSION['status']="success";
        header("Location:../production/category-edit.php?category_id=$category_id&success");
        exit;
    } else {
        $_SESSION['status']="error";
        header("Location:../production/category-edit.php?category_id=$category_id&error");
        exit;
    }
}
/*Category-Edit*/

/*Category-Remove*/
if ($_GET['categoryremove']=="approval") {
    commandcontrol();
	$categoryremove=$db->prepare("DELETE from categories where category_id=:id");
	$categorycontrol=$categoryremove->execute(array(
		'id' => $_GET['category_id']
		));
	if ($categorycontrol) {
		header("location:../production/categories.php?remove=success");
	} else {
		header("location:../production/categories.php?remove=error");
	}
}
/*Category-Remove*/

/*Category-Add*/
if (isset($_POST['categoryadd'])) {
    $category_seourl=seo($_POST['category_name']);
    $sql=$db->prepare("INSERT INTO categories SET 
        category_name=:category_name,
        category_order=:category_order,
        category_seourl=:category_seourl,
        category_status=:category_status
    ");
    $insert=$sql->execute(
        [
            'category_name' => $_POST['category_name'],
            'category_order' => $_POST['category_order'],
            'category_seourl' => $category_seourl,
            'category_status' => $_POST['category_status']
        ]
    );

    if($insert) {
        header("Location:../production/categories.php?status=success");
        exit;
    } else {
        header("Location:../production/categories.php?status=error");
        exit;
    }
}
/*Category-Add*/

/*Product-Remove*/
if ($_GET['productremove']=="approval") {
    commandcontrol();
	$productremove=$db->prepare("DELETE from product where product_id=:id");
	$productcontrol=$productremove->execute(array(
		'id' => $_GET['product_id']
		));
	if ($productcontrol) {
		header("location:../production/product.php?remove=success");
	} else {
		header("location:../production/product.php?remove=error");
	}
}
/*Product-Remove*/

/*Product-Edit*/
if (isset($_POST['productedit_save'])) {
    $product_id=$_POST['product_id'];
    $product_seourl=seo($_POST['product_name']);
    $sql=$db->prepare("UPDATE product SET 
        category_id=:category,
        product_name=:name,
        product_status=:status,
        product_price=:price,
        product_stock=:stock,
        product_detail=:detail,
        product_video=:video,
        product_keyword=:keyword,
        product_order=:order,
        product_homeshowcase=:homeshowcase,
        product_seourl=:seourl
        WHERE product_id={$_POST['product_id']}
    ");
    $update=$sql->execute(
        [
            'category' => $_POST['category_id'],
            'name' => $_POST['product_name'],
            'status' => $_POST['product_status'],
            'price' => $_POST['product_price'],
            'stock' => $_POST['product_stock'],
            'detail' => $_POST['product_detail'],
            'video' => $_POST['product_video'],
            'keyword' => $_POST['product_keyword'],
            'order' => $_POST['product_order'],
            'homeshowcase' => $_POST['product_homeshowcase'],
            'seourl' => $product_seourl
        ]
    );

    if($update) {
        $_SESSION['status']="success";
        header("Location:../production/product-edit.php?product_id=$product_id&success");
        exit;
    } else {
        $_SESSION['status']="error";
        header("Location:../production/product-edit.php?product_id=$product_id&error");
        exit;
    }
}
/*Product-Edit*/

/*Product-Add*/
if (isset($_POST['productadd'])) {
    $product_seourl=seo($_POST['product_name']);
    $sql=$db->prepare("INSERT INTO product SET 
        category_id=:category,
        product_name=:name,
        product_status=:status,
        product_price=:price,
        product_stock=:stock,
        product_detail=:detail,
        product_video=:video,
        product_keyword=:keyword,
        product_order=:order,
        product_homeshowcase=:homeshowcase,
        product_seourl=:seourl
    ");
    $insert=$sql->execute(
        [
            'category' => $_POST['category_id'],
            'name' => $_POST['product_name'],
            'status' => $_POST['product_status'],
            'price' => $_POST['product_price'],
            'stock' => $_POST['product_stock'],
            'detail' => $_POST['product_detail'],
            'video' => $_POST['product_video'],
            'keyword' => $_POST['product_keyword'],
            'order' => $_POST['product_order'],
            'homeshowcase' => $_POST['product_homeshowcase'],
            'seourl' => $product_seourl
        ]
    );

    if($insert) {
        header("Location:../production/product.php?status=success");
        exit;
    } else {
        header("Location:../production/product.php?status=error");
        exit;
    }
}
/*Product-Add*/

/*Admin - Home Showcase Button */
if ($_GET['product_homeshowcase']=="passive") {

	$edit=$db->prepare("UPDATE product SET
		product_homeshowcase=:product_homeshowcase
		WHERE product_id={$_GET['product_id']}");
	$update=$edit->execute(array(
		'product_homeshowcase' => $_GET['product_hs']
		));
	if ($update) {
		header("Location:../production/product.php");
        exit;
	}
} elseif ($_GET['product_homeshowcase']=="active") {
	$edit=$db->prepare("UPDATE product SET
		product_homeshowcase=:product_homeshowcase
		WHERE product_id={$_GET['product_id']}");
	$update=$edit->execute(array(
		'product_homeshowcase' => $_GET['product_hs']
		));
	if ($update) {
		header("Location:../production/product.php");
        exit;
	}
}
/*Admin - Home Showcase Button */

/*Comment-Save*/
if (isset($_POST['comment_save'])) {
    $page_url=$_POST['page_url'];
    $sql=$db->prepare("INSERT INTO comments SET 
        comment_detail=:comment_detail,
        user_id=:user_id,
        product_id=:product_id
    ");
    $insert=$sql->execute(
        [
            'comment_detail' => $_POST['comment_detail'],
            'user_id' => $_POST['user_id'],
            'product_id' => $_POST['product_id']
        ]
    );

    if($insert) {
        header("Location:$page_url?status=success");
        exit;
    } else {
        header("Location:$page_url?status=error");
        exit;
    }
}
/*Comment-Save*/

/*Comment Status*/
if ($_GET['comment_status']=="passive") {

	$edit=$db->prepare("UPDATE comments SET
		comment_status=:comment_status
		WHERE comment_id={$_GET['comment_id']}");
	$update=$edit->execute(array(
		'comment_status' => $_GET['comment_st']
		));
	if ($update) {
		header("Location:../production/comment.php");
        exit;
	}
} elseif ($_GET['comment_status']=="active") {
	$edit=$db->prepare("UPDATE comments SET
		comment_status=:comment_status
		WHERE comment_id={$_GET['comment_id']}");
	$update=$edit->execute(array(
		'comment_status' => $_GET['comment_st']
		));
	if ($update) {
		header("Location:../production/comment.php");
        exit;
	}
}
/*Comment Status*/

/*Comment-Remove*/
if ($_GET['commentremove']=="approval") {
    commandcontrol();
	$commentremove=$db->prepare("DELETE from comments where comment_id=:id");
	$commentcontrol=$commentremove->execute(array(
		'id' => $_GET['comment_id']
		));
	if ($commentcontrol) {
		header("location:../production/comment.php?remove=success");
	} else {
		header("location:../production/comment.php?remove=error");
	}
}
/*Comment-Remove*/

/*AddToCart*/
if (isset($_POST['addtocart'])) {
    $sql=$db->prepare("INSERT INTO basket SET 
        product_unit=:product_unit,
        user_id=:user_id,
        product_id=:product_id
    ");
    $insert=$sql->execute(
        [
            'product_unit' => $_POST['product_unit'],
            'user_id' => $_POST['user_id'],
            'product_id' => $_POST['product_id']
        ]
    );

    if($insert) {
        header("Location:../../basket.php?status=success");
        exit;
    } else {
        header("Location:../../basket.php?status=error");
        exit;
    }
}
/*AddToCart*/

/*Bank-Add*/
if (isset($_POST['bankadd'])) {
    $sql=$db->prepare("INSERT INTO bank SET 
        bank_name=:bank_name,
        bank_iban=:bank_iban,
        bank_accountname=:bank_accountname,
        bank_status=:bank_status
    ");
    $insert=$sql->execute(
        [
            'bank_name' => $_POST['bank_name'],
            'bank_iban' => $_POST['bank_iban'],
            'bank_accountname' => $_POST['bank_accountname'],
            'bank_status' => $_POST['bank_status']
        ]
    );

    if($insert) {
        header("Location:../production/bank.php?status=success");
        exit;
    } else {
        header("Location:../production/bank.php?status=error");
        exit;
    }
}
/*Bank-Add*/

/*Bank-Edit*/
if (isset($_POST['bankedit_save'])) {
    $bank_id=$_POST['bank_id'];
    $sql=$db->prepare("UPDATE bank SET 
        bank_name=:bank_name,
        bank_iban=:bank_iban,
        bank_accountname=:bank_accountname,
        bank_status=:bank_status
        WHERE bank_id={$_POST['bank_id']}
    ");
    $update=$sql->execute(
        [
            'bank_name' => $_POST['bank_name'],
            'bank_iban' => $_POST['bank_iban'],
            'bank_accountname' => $_POST['bank_accountname'],
            'bank_status' => $_POST['bank_status']
        ]
    );

    if($update) {
        $_SESSION['status']="success";
        header("Location:../production/bank-edit.php?bank_id=$bank_id&success");
        exit;
    } else {
        $_SESSION['status']="error";
        header("Location:../production/bank-edit.php?bank_id=$bank_id&error");
        exit;
    }
}
/*Bank-Edit*/

/*Bank-Remove*/
if ($_GET['bankremove']=="approval") {
    commandcontrol();
	$bankremove=$db->prepare("DELETE from bank where bank_id=:id");
	$bankcontrol=$bankremove->execute(array(
		'id' => $_GET['bank_id']
		));
	if ($bankcontrol) {
		header("location:../production/bank.php?remove=success");
	} else {
		header("location:../production/bank.php?remove=error");
	}
}
/*Bank-Remove*/

/*User Password Update*/
if (isset($_POST['userpassword-update'])) {
	echo $user_oldpassword=trim($_POST['user_oldpassword']); echo "<br>";
	echo $user_passwordone=trim($_POST['user_passwordone']); echo "<br>";
	echo $user_passwordtwo=trim($_POST['user_passwordtwo']); echo "<br>";

	$user_password=md5($user_oldpassword);

	$userbring=$db->prepare("SELECT * FROM user WHERE user_password=:password");
	$userbring->execute(array(
		'password' => $user_password
		));
	$say=$userbring->rowCount();
	if ($say==0) {
		header("Location:../../password-change?status=oldpasswordfalse");
	} else {
		if ($user_passwordone==$user_passwordtwo) {
			if (strlen($user_passwordone)>=6) {
				$password=md5($user_passwordone);
				$usersave=$db->prepare("UPDATE user SET
					user_password=:user_password
					WHERE user_id={$_POST['user_id']}");
				$insert=$usersave->execute(array(
					'user_password' => $password
					));
				if ($insert) {
					header("Location:../../password-change.php?status=changesuccessful");
				} else {
					header("Location:../../password-change.php?status=error");
				}
			} else {
				header("Location:../../password-change.php?status=missingpassword");
			}
		} else {
			header("Location:../../password-change.php?status=notsame");
			exit;
		}
	}
	exit;
	if ($update) {
		header("Location:../../password-change.php?status=success");
	} else {
		header("Location:../../password-change.php?status=error");
	}
}
/*User Password Update*/

/*Order*/
if (isset($_POST['bank_orderadd'])) {
    $order_type="Bank Payment";
    $save=$db->prepare("INSERT INTO orders SET
        user_id=:user_id,
        order_type=:order_type,	
        order_bank=:order_bank,
        order_total=:order_total
        ");
    $insert=$save->execute(array(
        'user_id' => $_POST['user_id'],
        'order_type' => $order_type,
        'order_bank' => $_POST['order_bank'],
        'order_total' => $_POST['order_total']		
    ));
    if ($insert) {
        echo $order_id = $db->lastInsertId();
        echo "<hr>";
        $user_id=$_POST['user_id'];
        $basketcheck=$db->prepare("SELECT * FROM basket where user_id=:id");
		$basketcheck->execute(array(
			'id' => $user_id
			));
		while($basketbring=$basketcheck->fetch(PDO::FETCH_ASSOC)) {
			$product_id=$basketbring['product_id']; 
			$product_unit=$basketbring['product_unit'];

            $productcheck=$db->prepare("SELECT * FROM product where product_id=:id");
			$productcheck->execute(array(
				'id' => $product_id
				));
			$productbring=$productcheck->fetch(PDO::FETCH_ASSOC);
			$product_price=$productbring['product_price'];

            $save=$db->prepare("INSERT INTO orders_detail SET
                order_id=:order_id,
                product_id=:product_id,	
                product_price=:product_price,
                product_unit=:product_unit
            ");
            $insert=$save->execute(array(
                'order_id' => $order_id,
                'product_id' => $product_id,
                'product_price' => $product_price,
                'product_unit' => $product_unit	
            ));
        }
        if ($insert) {
			$remove=$db->prepare("DELETE from basket where user_id=:user_id");
			$check=$remove->execute(array(
				'user_id' => $user_id
				));
			Header("Location:../../orders?status=success");
			exit;
		}
	} else {
		Header("Location:../../orders?status=error");
        exit;
	}
}
/*Order*/

/*Photo Remove*/
if(isset($_POST['productphoto-remove'])) {
    commandcontrol();
	$product_id=$_POST['product_id'];
	echo $checklist = $_POST['productphoto_choose'];
	foreach($checklist as $list) {
		$remove=$db->prepare("DELETE from product_photo where productphoto_id=:productphoto_id");
		$check=$remove->execute(array(
			'productphoto_id' => $list
			));
	}
	if ($check) {
		Header("Location:../production/product-galery.php?product_id=$product_id&status=success");
        exit;
	} else {
		Header("Location:../production/product-galery.php?product_id=$product_id&status=error");
        exit;
	}
} 
/*Photo Remove*/

?>