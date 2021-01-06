<?php
// error_reporting(E_ALL^(E_NOTICE|E_WARNING));

session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "c_linic";

// $config = pg_connect("host=localhost port=5432 dbname=apotek user='postgres' password='user'");
$config = mysqli_connect($host, $user, $pass, $db);

if (!$config) {
    echo " <h1 align='center'> ERROR CONNECT TO DATABASE!</h1> ";
    exit();
} else {

    $base_url    = "/my-klinik/";
    // echo $base_url;
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);

    date_default_timezone_set("Asia/Jakarta");
    $day           = date("D");
    $currentDate   = date("Y-m-d");
    $currentTime   = date("H:i:s");
    $currentTimeStamp = $currentDate . " " . $currentTime;

    if (isset($_SESSION['login'])) {
        $sessionUser        = $_SESSION['login']['user_name'];
        $sessionAccess      = $_SESSION['login']['access_level'];
        $sessionFullName    = $_SESSION['login']['full_name'];
        // $sessionAddress     = $_SESSION['login']['address'];
        // $sessionEmail       = $_SESSION['login']['email'];
        // $sessionPhone       = $_SESSION['login']['phone'];
        // $sessionGender      = $_SESSION['login']['gender'];
    }

    function generate($panjang)
    {
        $karakter = date('His' . substr(microtime(), 2, 6));
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{
                $pos};
        }
        return $string;
    }
    $generateID     = sha1(generate(20));
    $generateCode   = generate(6);

    // Time 
    $b = time();
    $hour = date("G", $b);

    if ($hour >= 0 && $hour <= 12) {
        $ucapan = "Selamat Pagi";
    } elseif ($hour > 12 && $hour <= 14) {
        $ucapan = "Selamat Siang ";
    } elseif ($hour > 14 && $hour <= 18) {
        $ucapan = "Selamat Sore ";
    } elseif ($hour > 18 && $hour <= 23) {
        $ucapan = "Selamat Malam ";
    }

    $headerName = date('ymd-His');

    $hari = date('w');
    $tgl = date('d');
    $bln = date('m');
    $thn = date('Y');
    $jam = date('H');
    $mnt = date('i');
    $dtk = date('s');
    switch ($hari) {
        case 0: {
                $hari = 'Ahad';
            }
            break;
        case 1: {
                $hari = 'Senin';
            }
            break;
        case 2: {
                $hari = 'Selasa';
            }
            break;
        case 3: {
                $hari = 'Rabu';
            }
            break;
        case 4: {
                $hari = 'Kamis';
            }
            break;
        case 5: {
                $hari = "Jum'at";
            }
            break;
        case 6: {
                $hari = 'Sabtu';
            }
            break;
        default: {
                $hari = 'UnKnown';
            }
            break;
    }

    switch ($bln) {
        case 1: {
                $bln = 'Jan';
            }
            break;
        case 2: {
                $bln = 'Feb';
            }
            break;
        case 3: {
                $bln = 'Maret';
            }
            break;
        case 4: {
                $bln = 'April';
            }
            break;
        case 5: {
                $bln = 'Mei';
            }
            break;
        case 6: {
                $bln = "Juni";
            }
            break;
        case 7: {
                $bln = 'Juli';
            }
            break;
        case 8: {
                $bln = 'Agust';
            }
            break;
        case 9: {
                $bln = 'Sept';
            }
            break;
        case 10: {
                $bln = 'Okt';
            }
            break;
        case 11: {
                $bln = 'Nov';
            }
            break;
        case 12: {
                $bln = 'Des';
            }
            break;
        default: {
                $bln = 'UnKnown';
            }
            break;
    }
    // *************** SYSTEM SETTING ************** //
    $query =  mysqli_query($config, " 
    SELECT * FROM tb_system_setting 
    WHERE id_transaction = '1' ");

    $number = 0;
    $check_qty = mysqli_num_rows($query);

    if ($check_qty < 1) {

        $system_title           = 'Belum Di Setting';
        $system_header          = 'Belum Di Setting';
        $system_dashboard_text  = 'Belum Di Setting';
        $system_instansi_name   = 'Belum Di Setting';
        $system_owner           = 'Belum Di Setting';
        $system_phone           = 'Belum Di Setting';
        $system_address         = 'Belum Di Setting';
        $system_email           = 'Belum Di Setting';
        $system_url             = 'Belum Di Setting';
        $system_footer_struct   = 'Belum Di Setting';
    } else {

        while ($row = mysqli_fetch_array($query)) {
            $number                 = $number + 1;
            $id_system              = $row['id_system'];
            $system_title           = $row['system_title'];
            $system_header          = $row['system_header'];
            $system_dashboard_text  = $row['system_dashboard_text'];
            $system_instansi_name   = $row['system_instansi_name'];
            $system_owner           = $row['system_owner'];
            $system_phone           = $row['system_phone'];
            $system_address         = $row['system_address'];
            $system_email           = $row['system_email'];
            $system_url             = $row['system_url'];
            $system_outlet_code     = $row['system_outlet_code'];
            $system_footer_struct   = $row['system_footer_struct'];
        }
    }
}

// LOG FUNCTION

function browser_user()
{
    $browser = _userAgent();
    return $browser['name'] . ' v.' . $browser['version'];
}

/**
 * Deteksi UserAgent / Browser yang digunakan
 * @return [type] [description]
 */
function _userAgent()
{
    $u_agent    = $_SERVER['HTTP_USER_AGENT'];
    $bname      = 'Unknown';
    $platform   = 'Unknown';
    $version    = "";

    $os_array   =   array(
        '/windows nt 10.0/i'    =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $u_agent)) {
            $platform    =   $value;
            break;
        }
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    //  finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    $version = ($version == null || $version == "") ? "?" : $version;

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'   => $pattern
    );
}

/**
 * @return name Operating System*/
function os_user()
{
    $OS = _userAgent();
    return $OS['platform'];
}

$os      = os_user();
$browser = browser_user();

// -- LOG FUNCTION -- //
function log_insert($log_menu, $log_description, $ip_address, $os, $browser)
{
    $insertLogData = "INSERT INTO log_activity(
        id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
        VALUES ( '" . sha1(generate(10)) . "', '" . date('Y-m-d H:i:s') . "', '$log_menu', '$log_description' , 'A', '$ip_address', '" . $_SESSION['login']['user_name'] . "', '$os', '$browser')";

    return $insertLogData;
}

echo `<script>
    
    </script>`;

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
