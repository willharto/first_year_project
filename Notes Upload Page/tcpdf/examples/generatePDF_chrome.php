<?php
set_time_limit(300);
ini_set('memory_limit', '512M');
error_reporting(E_ERROR | E_PARSE);
session_start();
$id = $_SESSION['id'];
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
include "../../header.php";
include "../../take-png.php";

// TAKING LOGOS AND BACKGROUNDS FROM THE DATABASE
	//take industry number
		$take_industry_num = "SELECT * FROM Clients WHERE ID = '" . $id . "';";
	    $take_industry_num_result = mysqli_query($conn, $take_industry_num) or die("Cannot fetch information from Clients.");
	    while ($row_take_industry_num = mysqli_fetch_array($take_industry_num_result)) {
	        extract($row_take_industry_num);
	        $industry_num = $row_take_industry_num['industry'];
	    }
	//------------------------------------------------------------------------------



	//Take logo and background for login
		$check_logo_img = "SELECT logo_img FROM Login WHERE ID = '" . $id . "';";
	    $check_logo_img_result = mysqli_query($conn, $check_logo_img) or die("Cannot fetch information from Login.");
	    while ($row_check_logo_img = mysqli_fetch_array($check_logo_img_result)) {
	        extract($row_check_logo_img);
	        if ($row_check_logo_img['logo_img'] != NULL) {
	            $logo_img_exists = 1;
	        }
	    }
	    
	    if ($logo_img_exists == 1) {
	        $check_logo_img_result = mysqli_query($conn, $check_logo_img) or die("Cannot fetch information from Login.");
	        while ($row_check_logo_img = mysqli_fetch_array($check_logo_img_result)) {
	            extract($row_check_logo_img);
	            $custom_logo_img = "data:image/jpeg;base64," . base64_encode($row_check_logo_img['logo_img']);
	        }
	    } else {
	        if ($industry_num == 0) {
	            $custom_logo_img = "../../../Login-screen/Logos/your-logo-here-White.png";
	        }
	        
	        elseif ($industry_num == 1) {
	            $custom_logo_img = "../../../Login-screen/Logos/your-logo-here-Orange.png";
	        } elseif ($industry_num == 2) {
	            $custom_logo_img = "../../../Login-screen/Logos/your-logo-here-White.png";
	        } elseif ($industry_num == 3) {
	            $custom_logo_img = "../../../Login-screen/Logos/your-logo-here-White.png";
	        } elseif ($industry_num == 4) {
	            $custom_logo_img = "../../../Login-screen/Logos/your-logo-here-White.png";
	        } elseif ($industry_num == 5) {
	            $custom_logo_img = "../../../Login-screen/Logos/your-logo-here-Blue.png";
	        }
	    }

	    $_SESSION['logo_login'] = $custom_logo_img;

	    $check_background_img = "SELECT background_img FROM Login WHERE ID = '" . $id . "';";
	    $check_background_img_result = mysqli_query($conn, $check_background_img) or die("Cannot fetch information from Login.");
	    while ($row_check_background_img = mysqli_fetch_array($check_background_img_result)) {
	        extract($row_check_background_img);
	        if ($row_check_background_img['background_img'] != NULL) {
	            $background_img_exists = 1;
	        }
	    }
	    
	    if ($background_img_exists == 1) {
	        $check_background_img_result = mysqli_query($conn, $check_background_img) or die("Cannot fetch information from Login.");
	        while ($row_check_background_img = mysqli_fetch_array($check_background_img_result)) {
	            extract($row_check_background_img);
	            $custom_background_img = "data:image/jpeg;base64," . base64_encode($row_check_background_img['background_img']);
	        }
	    }
	    
	    else {
	        
	        if ($industry_num == 0) {
	            $custom_background_img = "../../../Login-screen/Screens/PhoneBackground-images/Tourist-Boards.png";
	        } 
	        elseif ($industry_num == 1) {
	            $custom_background_img = "../../../Login-screen/Screens/PhoneBackground-images/Retail.png";
	        } elseif ($industry_num == 2) {
	            $custom_background_img = "../../../Login-screen/Screens/PhoneBackground-images/Horeca.png";
	        } elseif ($industry_num == 3) {
	            $custom_background_img = "../../../Login-screen/Screens/PhoneBackground-images/Media.png";
	        } elseif ($industry_num == 4) {
	            $custom_background_img = "../../../Login-screen/Screens/PhoneBackground-images/HR-and-Trainings.png";
	        } elseif ($industry_num == 5) {
	            $custom_background_img = "../../../Login-screen/Screens/PhoneBackground-images/Banks-and-Telcos.png";
	        }
	    }

	    $_SESSION['background_login'] = $custom_background_img;
	//------------------------------------------------------------------------------

	//Take logo for side menu
		$check_logo_img_side_menu = "SELECT logo_img FROM Side_Menu WHERE ID = '" . $id . "';";
	    $check_logo_img_side_menu_result = mysqli_query($conn, $check_logo_img_side_menu) or die("Cannot fetch information from Side Menu.");
	    while ($row_check_logo_img_side_menu = mysqli_fetch_array($check_logo_img_side_menu_result)) {
	        extract($row_check_logo_img_side_menu);
	        if ($row_check_logo_img_side_menu['logo_img'] != NULL) {
	            $logo_img_side_menu_exists = 1;
	        }
	    }
	    
	    if ($logo_img_side_menu_exists == 1) {
	        $check_logo_img_side_menu_result = mysqli_query($conn, $check_logo_img_side_menu) or die("Cannot fetch information from Login.");
	        while ($row_check_logo_img_side_menu = mysqli_fetch_array($check_logo_img_side_menu_result)) {
	            extract($row_check_logo_img_side_menu);
	            $custom_logo_img_side_menu = "data:image/jpeg;base64," . base64_encode($row_check_logo_img_side_menu['logo_img']);
	        }
	    } else {
	        if ($industry_num == 0) {
	            $custom_logo_img_side_menu = "../../../SideMenu/Logos/your-logo-here-White.png";
	        }
	        
	        elseif ($industry_num == 1) {
	            $custom_logo_img_side_menu = "../../../SideMenu/Logos/your-logo-here-Orange.png";
	        } elseif ($industry_num == 2) {
	            $custom_logo_img_side_menu = "../../../SideMenu/Logos/your-logo-here-Purple.png";
	        } elseif ($industry_num == 3) {
	            $custom_logo_img_side_menu = "../../../SideMenu/Logos/your-logo-here-White.png";
	        } elseif ($industry_num == 4) {
	            $custom_logo_img_side_menu = "../../../SideMenu/Logos/your-logo-here-White.png";
	        } elseif ($industry_num == 5) {
	            $custom_logo_img_side_menu = "../../../SideMenu/Logos/your-logo-here-Blue.png";
	        }
	    }

	    $_SESSION['logo_side_menu'] = $custom_logo_img_side_menu;
	//------------------------------------------------------------------------------

	//Take logo for near me
		$check_logo_img_near_me = "SELECT logo_img FROM Near_Me WHERE ID = '" . $id . "';";
	    $check_logo_img_near_me_result = mysqli_query($conn, $check_logo_img_near_me) or die("Cannot fetch information from Near Me.");
	    while ($row_check_logo_img_near_me = mysqli_fetch_array($check_logo_img_near_me_result)) {
	        extract($row_check_logo_img_near_me);
	        if ($row_check_logo_img_near_me['logo_img'] != NULL) {
	            $logo_img_near_me_exists = 1;
	        }
	    }
	    
	    if ($logo_img_near_me_exists == 1) {
	        $check_logo_img_near_me_result = mysqli_query($conn, $check_logo_img_near_me) or die("Cannot fetch information from Near Me.");
	        while ($row_check_logo_img_near_me = mysqli_fetch_array($check_logo_img_near_me_result)) {
	            extract($row_check_logo_img_near_me);
	            $custom_logo_img_near_me = "data:image/jpeg;base64," . base64_encode($row_check_logo_img_near_me['logo_img']);
	        }
	    } else {
	        if ($industry_num == 0) {
	            $custom_logo_img_near_me = "../../../NearMe/Logos/your-logo-here-White.png";
	        }
	        
	        elseif ($industry_num == 1) {
	            $custom_logo_img_near_me = "../../../NearMe/Logos/your-logo-here-Orange.png";
	        } elseif ($industry_num == 2) {
	            $custom_logo_img_near_me = "../../../NearMe/Logos/your-logo-here-Purple.png";
	        } elseif ($industry_num == 3) {
	            $custom_logo_img_near_me = "../../../NearMe/Logos/your-logo-here-White.png";
	        } elseif ($industry_num == 4) {
	            $custom_logo_img_near_me = "../../../NearMe/Logos/your-logo-here-White.png";
	        } elseif ($industry_num == 5) {
	            $custom_logo_img_near_me = "../../../NearMe/Logos/your-logo-here-Blue.png";
	        }
	    }

	    $_SESSION['logo_near_me'] = $custom_logo_img_near_me;
	//------------------------------------------------------------------------------

	//Take background for profile

	    $check_background_img_profile = "SELECT background_img FROM Profile WHERE ID = '" . $id . "';";
	    $check_background_img_profile_result = mysqli_query($conn, $check_background_img_profile) or die("Cannot fetch information from Profile.");
	    while ($row_check_background_img_profile = mysqli_fetch_array($check_background_img_profile_result)) {
	        extract($row_check_background_img_profile);
	        if ($row_check_background_img_profile['background_img'] != NULL) {
	            $background_img_profile_exists = 1;
	        }
	    }
	    
	    if ($background_img_profile_exists == 1) {
	        $check_background_img_profile_result = mysqli_query($conn, $check_background_img_profile) or die("Cannot fetch information from Near Me.");
	        while ($row_check_background_img_profile = mysqli_fetch_array($check_background_img_profile_result)) {
	            extract($row_check_background_img_profile);
	            $custom_background_img_profile = "data:image/jpeg;base64," . base64_encode($row_check_background_img_profile['background_img']);
	        }
	    } else {
	        if ($industry_num == 0) {
	            $custom_background_img_profile = "../../../Profile/Backgrounds/Tourist-Boards.png";
	        }
	        
	        elseif ($industry_num == 1) {
	            $custom_background_img_profile = "../../../Profile/Backgrounds/Retail.png";
	        } elseif ($industry_num == 2) {
	            $custom_background_img_profile = "../../../Profile/Backgrounds/Horeca.png";
	        } elseif ($industry_num == 3) {
	            $custom_background_img_profile = "../../../Profile/Backgrounds/Media.png";
	        } elseif ($industry_num == 4) {
	            $custom_background_img_profile = "../../../Profile/Backgrounds/HR-and-Trainings.png";
	        } elseif ($industry_num == 5) {
	            $custom_background_img_profile = "../../../Profile/Backgrounds/Banks-and-Telcos.png";
	        }
	    }

	    $_SESSION['background_profile'] = $custom_background_img_profile;
	//------------------------------------------------------------------------------

//take login png
	$login_png = $login_buttons_png;
	$imageContent_login = file_get_contents($login_png);
	$path_login = tempnam('\PDF', 'login_svg');
	file_put_contents ($path_login, $imageContent_login);
	$html_login = '<img src="' . $path_login . '">';

	$login_background = $_SESSION['background_login'];
	if ($login_background[0] == 'd'){
		$imageContent_login_background = file_get_contents($login_background);
		$path_login_background = tempnam('\PDF', 'login_background');
		file_put_contents ($path_login_background, $imageContent_login_background);
		$html_login_background = '<img src="' . $path_login_background . '">';
	}else{
		$html_login_background = '<img src="' . $login_background . '">';
	}
	$login_logo = $_SESSION['logo_login'];
	if ($login_logo[0] == 'd'){
		$imageContent_login_logo = file_get_contents($login_logo);
		$path_login_logo = tempnam('\PDF', 'login_logo');
		file_put_contents ($path_login_logo, $imageContent_login_logo);
		$html_login_logo = '<img src="' . $path_login_logo . '" style=" width: 1200px; height: 300px;">';
	}else{
		$html_login_logo = '<img src="' . $login_logo . '">';
	}

//take side menu png
	$imageContent_side_menu_left = file_get_contents($side_menu_left_png);
	$path_side_menu_left = tempnam('\PDF', 'side_menu_left_svg');
	file_put_contents ($path_side_menu_left, $imageContent_side_menu_left);
	$html_side_menu_left = '<img src="' . $path_side_menu_left . '">';

	$imageContent_side_menu_right = file_get_contents($side_menu_right_png);
	$path_side_menu_right = tempnam('\PDF', 'side_menu_right_svg');
	file_put_contents ($path_side_menu_right, $imageContent_side_menu_right);
	$html_side_menu_right = '<img src="' . $path_side_menu_right . '">';

	$side_menu_logo = $_SESSION['logo_side_menu'];
	if ($side_menu_logo[0] == 'd'){
		$imageContent_side_menu_logo = file_get_contents($side_menu_logo);
		$path_side_menu_logo = tempnam('\PDF', 'side_menu_logo');
		file_put_contents ($path_side_menu_logo, $imageContent_side_menu_logo);
		$html_side_menu_logo = '<img src="' . $path_side_menu_logo . '" style=" width: 1200px; height: 300px;"> ';
	}else{
		$html_side_menu_logo = '<img src="' . $side_menu_logo . '">';
	}

//take near me png
	$imageContent_near_me_main = file_get_contents($near_me_main_png);
	$path_near_me_main = tempnam('\PDF', 'near_me_main_SVG');
	file_put_contents ($path_near_me_main, $imageContent_near_me_main);
	$html_near_me_main = '<img src="' . $path_near_me_main . '">';

	$preview_SVG = "SELECT * FROM Near_Me_SVG WHERE ID = '" . $id . "';";
          $preview_SVG_result = mysqli_query($conn, $preview_SVG) or die("Cannot fetch information from Near Me SVG.");
          while ($row_preview_SVG = mysqli_fetch_array($preview_SVG_result)) {
            extract($row_preview_SVG);
            $near_me_SVG_pin       = $row_preview_SVG['pin_SVG'];
          }

    $check_colors = "SELECT * FROM Near_Me WHERE ID = '" . $id . "';";
    $check_colors_result = mysqli_query($conn, $check_colors) or die("Cannot fetch information from Near Me.");
    while ($row_check_colors = mysqli_fetch_array($check_colors_result)) {
        extract($row_check_colors);
        $pin_color            = "#" . $row_check_colors['pin_color'];
    }

    if ($near_me_SVG_pin == NULL){
            $near_me_pin_exists = 0;
          }else {
          	$near_me_SVG_pin[539] = $pin_color[1];
	    	$near_me_SVG_pin[540] = $pin_color[2];
	    	$near_me_SVG_pin[541] = $pin_color[3];
	    	$near_me_SVG_pin[542] = $pin_color[4];
	    	$near_me_SVG_pin[543] = $pin_color[5];
	    	$near_me_SVG_pin[544] = $pin_color[6];
          	$near_me_pin_exists = 1;
          	}

          if ($near_me_pin_exists == 0){
            $check_pin_img = "SELECT * FROM Near_Me WHERE ID = '" . $id . "';";
            $check_pin_img_result = mysqli_query($conn, $check_pin_img) or die("Cannot fetch information from Near Me.");
            while ($row_check_pin_img = mysqli_fetch_array($check_pin_img_result)) {
              extract($row_check_pin_img);
              $near_me_img_pin  = "data:image/png;base64," . base64_encode($row_check_pin_img['pin_img']);
              $_SESSION['near_me_img_pin'] = $near_me_img_pin;
            }
          }

	$near_me_custom_pin = $near_me_img_pin;

	if ($near_me_custom_pin == ""){
		$imageContent_near_me_pin = file_get_contents($near_me_pin_png);
		$path_near_me_pin = tempnam('\PDF', 'near_me_pin_svg');
		file_put_contents ($path_near_me_pin, $imageContent_near_me_pin);
		$html_near_me_pin = '<img src="' . $path_near_me_pin . '">';
	}else {
		$imageContent_near_me_pin = file_get_contents($near_me_custom_pin);
		$path_near_me_pin = tempnam('\PDF', 'near_me_pin_png');
		file_put_contents ($path_near_me_pin, $imageContent_near_me_pin);
		$html_near_me_custom_pin = '<img src="' . $path_near_me_pin . '" style = "width: 25px;">';
	}

	$near_me_logo = $_SESSION['logo_near_me'];
	if ($near_me_logo[0] == 'd'){
		$imageContent_near_me_logo = file_get_contents($near_me_logo);
		$path_near_me_logo = tempnam('\PDF', 'near_me_logo');
		file_put_contents ($path_near_me_logo, $imageContent_near_me_logo);
		$html_near_me_logo = '<img src="' . $path_near_me_logo . '" style=" width: 1200px; height: 300px;">';
	}else{
		$html_near_me_logo = '<img src="' . $near_me_logo . '">';
	}

//take profile png
	$profile_front_png = $profile_main_png;
	$imageContent_profile_front = file_get_contents($profile_front_png);
	$path_profile_front = tempnam('\PDF', 'profile_front_SVG');
	file_put_contents ($path_profile_front, $imageContent_profile_front);
	$html_profile_front = '<img src="' . $path_profile_front . '">';

	$imageContent_profile_bars = file_get_contents($profile_bars_png);
	$path_profile_bars = tempnam('\PDF', 'profile_bars_SVG');
	file_put_contents ($path_profile_bars, $imageContent_profile_bars);
	$html_profile_bars = '<img src="' . $path_profile_bars . '">';

	$profile_background = $_SESSION['background_profile'];
	if ($profile_background[0] == 'd'){
		$imageContent_profile_background = file_get_contents($profile_background);
		$path_profile_background = tempnam('\PDF', 'profile_background');
		file_put_contents ($path_profile_background, $imageContent_profile_background);
		$html_profile_background = '<img src="' . $path_profile_background . '">';
	}else{
		$html_profile_background = '<img src="' . $profile_background . '">';
	}

//take offers png
	$imageContent_offers_main = file_get_contents($offers_main_png);
	$path_offers_main = tempnam('\PDF', 'offers_main_SVG');
	file_put_contents ($path_offers_main, $imageContent_offers_main);
	$html_offers_main = '<img src="' . $path_offers_main . '">';

	$imageContent_offers_text = file_get_contents($offers_text_png);
	$path_offers_text = tempnam('\PDF', 'offers_text_SVG');
	file_put_contents ($path_offers_text, $imageContent_offers_text);
	$html_offers_text = '<img src="' . $path_offers_text . '">';

//take scanner png
	$imageContent_scanner_main = file_get_contents($scanner_main_png);
	$path_scanner_main = tempnam('\PDF', 'scanner_main_SVG');
	file_put_contents ($path_scanner_main, $imageContent_scanner_main);
	$html_scanner_main = '<img src="' . $path_scanner_main . '">';

	$imageContent_scanner_bars = file_get_contents($scanner_bars_png);
	$path_scanner_bars = tempnam('\PDF', 'scanner_bars_SVG');
	file_put_contents ($path_scanner_bars, $imageContent_scanner_bars);
	$html_scanner_bars = '<img src="' . $path_scanner_bars . '">';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('iClarity corporation');
$pdf->SetSubject('New mobile application');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 16);

// add a page
$pdf->AddPage();
$pdf->SetTextColor(3,123,174);

// set background
$pdf->Image('../../../Home-page/Background/Background.png',0,0,209,200);
$pdf->Image('../../../Home-page/Background/Background.png',0,72,209,200);

// set logo
$pdf->Image('../../../Choose-industry/Icons/iClarity-logo.png',86,5,40);

// set heading text
$pdf->MultiCell( 0, 0, 'This is a preview of your app.', 0, 'C');

// set text for ID
$pdf->SetY(39);
$pdf->MultiCell(150, 0, 'Your ID is:', 0, C);
$pdf->SetFont('helvetica', 'B', 25);
$pdf->SetTextColor(102, 102, 102);
$pdf->SetY(36);
$pdf->MultiCell(210, 0, $id, 0, C);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetTextColor(3, 123, 174);

//set heading for login screen
$pdf->SetY(55);
$pdf->MultiCell(50, 0, 'Login Screen', 0, C);

//set phone for login screen
$pdf->Image('../../../Choose-industry/Phone/Phone-frame/PhoneFrame.png',12.5,59,55);

//set phone png for login
$pdf->writeHTMLCell(40.5, $h, 19.5, 74, $html_login_background);
$pdf->writeHTMLCell(39, $h, 20, 83, $html_login_logo);
$pdf->writeHTMLCell(130, $h, 16, 75, $html_login);

//set heading for side menu
$pdf->SetY(55);
$pdf->MultiCell(180, 0, 'Side Menu', 0, C);

//set phone for side menu
$pdf->Image('../../../Choose-industry/Phone/Phone-frame/PhoneFrame.png',78,59,55);

//set phone png for side menu
$pdf->writeHTMLCell(120.9, $h, 83, 73, $html_side_menu_right);
$pdf->writeHTMLCell(121, $h, 83, 73, $html_side_menu_left);
$pdf->writeHTMLCell(27, $h, 85.4, 82, $html_side_menu_logo);

//set heading for near me
$pdf->SetY(55);
$pdf->MultiCell(308, 0, 'Near Me', 0, C);

//set phone for near me
$pdf->Image('../../../Choose-industry/Phone/Phone-frame/PhoneFrame.png',142,59,55);

//set phone png for near me
	$pdf->writeHTMLCell(122.35, $h, 146.5, 73, $html_near_me_main);
	$pdf->writeHTMLCell(27, $h, 155.5, 75, $html_near_me_logo);
	if ($html_near_me_pin == ""){
		$pdf->writeHTMLCell(290, $h, 154.5, 89.3, $html_near_me_custom_pin);
		$pdf->writeHTMLCell(290, $h, 176, 87.8, $html_near_me_custom_pin);
		$pdf->writeHTMLCell(290, $h, 165.5, 103.1, $html_near_me_custom_pin);
		$pdf->writeHTMLCell(290, $h, 178.7, 105.1, $html_near_me_custom_pin);
		$pdf->writeHTMLCell(290, $h, 150, 112.3, $html_near_me_custom_pin);
		$pdf->writeHTMLCell(290, $h, 164.5, 119.8, $html_near_me_custom_pin);
	}
	else {
		$pdf->writeHTMLCell(8, $h, 155, 90, $html_near_me_pin);
		$pdf->writeHTMLCell(8, $h, 176.5, 88.5, $html_near_me_pin);
		$pdf->writeHTMLCell(8, $h, 166, 103.8, $html_near_me_pin);
		$pdf->writeHTMLCell(8, $h, 179.2, 105.8, $html_near_me_pin);
		$pdf->writeHTMLCell(8, $h, 150.5, 113, $html_near_me_pin);
		$pdf->writeHTMLCell(8, $h, 165, 120.5, $html_near_me_pin);
	}
	$pdf->SetTextColor(255, 255, 255);
	$pdf->SetFont('helvetica', '', 7);
	$pdf->SetY(91.5);
	$pdf->MultiCell(288.1, 0, '3', 0, C);
	$pdf->SetY(90);
	$pdf->MultiCell(331, 0, '3', 0, C);
	$pdf->SetY(105.3);
	$pdf->MultiCell(310, 0, '2', 0, C);
	$pdf->SetY(107.3);
	$pdf->MultiCell(336.3, 0, '2', 0, C);
	$pdf->SetY(114.5);
	$pdf->MultiCell(279, 0, '5', 0, C);
	$pdf->SetY(122.1);
	$pdf->MultiCell(308.1, 0, '3', 0, C);


	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->SetTextColor(3, 123, 174);

//set heading for profile
$pdf->SetY(165);
$pdf->MultiCell(50, 0, 'Profile', 0, C);

//set phone for profile
$pdf->Image('../../../Choose-industry/Phone/Phone-frame/PhoneFrame.png',12.5,169,55);

//set phone png for profile
$pdf->writeHTMLCell(40.6, $h, 19.4, 183.55, $html_profile_background);
$pdf->writeHTMLCell(131.6, $h, 18, 183.1, $html_profile_front);
$pdf->writeHTMLCell(131.6, $h, 18, 183.1, $html_profile_bars);
$pdf->writeHTMLCell(27, $h, 26, 185, $html_near_me_logo);


//set heading for side offers
$pdf->SetY(165);
$pdf->MultiCell(180, 0, 'Offers', 0, C);

//set phone for side offers
$pdf->Image('../../../Choose-industry/Phone/Phone-frame/PhoneFrame.png',78,169,55);

//set phone png for offers
$pdf->writeHTMLCell(131.6, $h, 83.4, 183.1, $html_offers_main);
$pdf->writeHTMLCell(131.6, $h, 83.4, 183.1, $html_offers_text);
$pdf->writeHTMLCell(27, $h, 92, 185, $html_near_me_logo);

//set heading for scanner
$pdf->SetY(165);
$pdf->MultiCell(308, 0, 'Scanner', 0, C);

//set phone for scanner
$pdf->Image('../../../Choose-industry/Phone/Phone-frame/PhoneFrame.png',142,169,55);

//set phone png for scanner
$pdf->writeHTMLCell(117.5, $h, 147.6, 183.1, $html_scanner_main);
$pdf->writeHTMLCell(117.5, $h, 147.6, 183.1, $html_scanner_bars);
$pdf->writeHTMLCell(27, $h, 156.5, 185, $html_near_me_logo);


//set footer text
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->SetY(266.5);
$pdf->MultiCell(0,0,'iClarity. All rights reserved. Privacy Policy and Terms of Service.',0,C);
$pdf->MultiCell(0,0,'www.iclarity.co.uk , sales@horizont.co.uk',0,C);
// ---------------------------------------------------------

//Close and output PDF document

//$pdf->Output("Application_'".$id."'.pdf", 'D');
$pdf->Output("Application_'".$id."'.pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+