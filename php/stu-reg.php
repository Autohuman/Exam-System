<?php
    require "conn.php";

    $truename = $_POST['truename'];
    $sex = $_POST['sex'];
    $paperno = $_POST['paper_no'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $school = $_POST['school'];
    $id = null;
    $error_message = "注册失败，请再次尝试";

    $sex_array = ['male', 'female'];

    if (empty($truename) || empty($sex) || empty($paperno) || empty($tel) || empty($email) || empty($school)) {
        echo("<script>window.alert('$error_message')</script>");
        echo ("<script>window.location = '../考生报名.html'</script>");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo("<script>window.alert('$error_message')</script>");
        echo ("<script>window.location = '../考生报名.html'</script>");
        exit();
    } else if (!in_array($sex, $sex_array)) {
        echo("<script>window.alert('$error_message')</script>");
        echo ("<script>window.location = '../考生报名.html'</script>");
        exit();
    } else {
        $sql_insert = "INSERT INTO sys.stu_info (stu_no,stu_name,sex,paper_no,tel,email,school) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql_insert)) {
            echo("<script>window.alert('$error_message')</script>");
            echo ("<script>window.location = '../考生报名.html'</script>");
            exit();
        } else {
            $get_id = "SELECT stu_no FROM sys.stu_no_reg WHERE status=1 ORDER BY  RAND() LIMIT 1;";
            $result1 = mysqli_query($conn,$get_id);
            if ($result1) {
                $row1 = mysqli_fetch_assoc($result1);
                $id = $row1['stu_no'];
                $status_sql = "UPDATE sys.stu_no_reg SET status = 0 WHERE stu_no = $id;";
                $update_status = mysqli_query($conn,$status_sql);
                if (!$update_status) {
                }else {
                    if ($update_status) {
                        mysqli_stmt_bind_param($stmt,"sssssss",$id,$truename,$sex,$paperno,$tel,$email,$school);
                        mysqli_stmt_execute($stmt);
                        $show = '您的考号是：'.$id.',请勿遗忘。';
                        echo("<script>window.alert('$show')</script>");
                        echo ("<script>window.location = '../index.html'</script>");
                        mysqli_stmt_close($stmt);
                    }else {

                        exit();
                    }
                }
            }
            else {
                    echo("<script>window.alert('$error_message')</script>");
                    echo ("<script>window.location = '../考生报名.html'</script>");
                exit();
            }
        }
    }
    mysqli_close($conn);