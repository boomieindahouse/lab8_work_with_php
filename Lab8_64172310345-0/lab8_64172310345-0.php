<?php
session_start();

$errors = array();

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

if (isset($_GET['add'])) {

    $fp = fopen("$DOCUMENT_ROOT/lab8_64172310345-0/menber.csv", 'a');

    $firstname = $_GET['namefirst'];
    $lastname = $_GET['namelast'];
    $sex = $_GET['sex'];
    $age = $_GET['age'];
    $tel = $_GET['tel'];

    if (empty($firstname)) {
        array_push($errors, "กรอกข้อมูลให้ครบ");
        $_SESSION['error'] = "กรอกข้อมูลให้ครบ";
    }
    if (empty($lastname)) {
        array_push($errors, "กรอกข้อมูลให้ครบ");
        $_SESSION['error'] = "กรอกข้อมูลให้ครบ";
    }
    if (empty($sex)) {
        array_push($errors, "กรอกข้อมูลให้ครบ");
        $_SESSION['error'] = "กรอกข้อมูลให้ครบ";
    }
    if (empty($age)) {
        array_push($errors, "กรอกข้อมูลให้ครบ");
        $_SESSION['error'] = "กรอกข้อมูลให้ครบ";
    }
    if (empty($tel)) {
        array_push($errors, "กรอกข้อมูลให้ครบ");
        $_SESSION['error'] = "กรอกข้อมูลให้ครบ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<style>
    body {
        text-align: center;
    }

    .texthead {
        text-align: center;
    }

    .boxtable {
        text-align: center;
        margin-left: 13cm;
    }

    table {
        border: 1px solid black;
        border-collapse: collapse;
        /* text-align: center; */
    }

    th {
        background-color: darkcyan;
        border: 1px solid black;
        border-collapse: collapse;
        /* text-align: center; */
    }

    td {
        background-color: lightskyblue;
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
        padding: 5px;
    }
</style>

<body>
    <div class="texthead">
        <h1>กรอกข้อมูล</h1>
    </div>
    <div class="boxtable">
        <form action="lab8_64172310345-0.php" method="get" name="form1" enctype="multipart/form-data">

            <table style="width:50%">
                <tr>
                    <th>ชื่อ:</th>
                    <td><input type="text" name="namefirst"></td>
                </tr>
                <tr>
                    <th>นามสกุล:</th>
                    <td><input type="text" name="namelast"></td>
                </tr>
                <tr>
                    <th>เพศ:</th>
                    <td><select name="sex">
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>อายุ:</th>
                    <td><input type="text" name="age"></td>
                </tr>
                <tr>
                    <th>เบอร์โทร:</th>
                    <td><input type="text" name="tel"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="add" value="เพิ่ม">
                        <input type="submit" name="show" value="แสดง">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <br><br>

    <?php
    if (isset($_GET['add'])) {
        if (!isset($_SESSION['error'])) {

            $data = $firstname . "," . $lastname . "," . $sex . "," . $age . "," . $tel . "\n";

            if (fputs($fp, $data) == true) {
                echo '<p style="color:green;">';
                echo 'เพิ่มข้อมูลลงไฟล์เรียบร้อย';
                echo '</p>';
            }
        }
        fclose($fp);
    }
    ?>

    <?php if (isset($_SESSION['error'])) : ?>
        <div>
            <p style="color:red;">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </p>
        </div>
    <?php endif ?>

    <?php if (isset($_GET['show'])) { ?>
    <div style="margin-left:15cm;">
        <table>
            <tr>
                <th style="background-color: brown; padding: 15px;">ชื่อ</th>
                <th style="background-color: brown; padding: 15px;">นามสกุล</th>
                <th style="background-color: brown; padding: 15px;">เพศ</th>
                <th style="background-color: brown; padding: 15px;">อายุ</th>
                <th style="background-color: brown; padding: 15px;">เบอร์โทร</th>
            </tr>

    <?php $fp = fopen("$DOCUMENT_ROOT/lab8_64172310345-0/menber.csv", 'r+');

        while (!feof($fp)) {
            $data = fgetcsv($fp, 999); ?>
            <tr>
                <?php for ($i = 0; $i < count($data); $i++) { ?>
                    <td style="background-color: lightcoral; padding: 5px;">
                        <?php echo $data[$i]; ?>
                    </td>
                <?php } ?>
            </tr>
        <?php  } ?>
    <?php } ?>
        </table>
    </div>
</body>

</html>