<?php
header("Content-type: application/json");
if (!isset($_GET['country']) || $_GET['country'] == "") die();

$country = $_GET['country'];
if ($country == "VN") {
?>
    
    <option value="">
        Select State
        </option>
    <option value="4044">
        Thanh pho Ho chi minh
        </option>
    <option value="4045">
        Nghe an
        </option>
    <option value="4046">
        Thanh pho Vinh
        </option>
    <option value="4047">
        Vinh long
        </option>
    <option value="4048">
        Dong thap
        </option>
    <option value="4049">
        Vinh phuc
        </option>
    <option value="4050">
        Dong Nai
        </option>
    <option value="4051">
        Ba ria Vung tau
        </option>
    <option value="4052">
        Bac ninh
        </option>
    <option value="4053">
        Thanh pho Binh duong
        </option>
    <option value="4054">
        Thanh pho Can tho
        </option>
    <option value="4055">
        Thanh hoa
        </option>
    <option value="4056">
        Hau giang
        </option>
    <option value="4057">
        An giang
        </option>
    <option value="4058">
        Kien giang
        </option>
    <option value="4059">
        Thanh Pho Ho Chi Minh
        </option>
    <option value="4060">
        Thu Do Ha Noi
        </option>
    <option value="4061">
        Tinh Can Tho
        </option>
    <option value="4062">
        Thanh pho Da Nang
        </option>
    <option value="4063">
        Tinh Gia Lai</option>"
        <?php } else { ?>
    <option value="">
        Select State
        </option>
    <option value="3924">
        California
        </option>
    <option value="3930">
        Florida
        </option>
    <option value="3932">
        Hawaii
        </option>
    <option value="3938">
        Kentucky
        </option>
    <option value="3942">
        Maryland
        </option>
    <option value="3943">
        Massachusetts
        </option>
    <option value="3947">
        Mississippi
        </option>
    <option value="3956">
        New York
        </option>
    <option value="3957">
        North Carolina
        </option>
    <option value="3970">
        Texas
        </option>
    <option value="3974">
        Virginia
        </option>
    <option value="3975">
        Washington
        </option>
    <option value="3976">
        West Virginia
        </option>
    <option value="3977">
        Wisconsin
        </option>
    <option value="4122">
        Washington DC</option>


        <?php } ?>