<?php
if (isset($_POST['query_submit'])) {
    require 'conn.php';
    $stu_no = $_POST['stu_no_id'];
    $name = $_POST['stu_name_pass'];
    $error_message = "查询失败，请重新尝试！";

    $sql_check_query = "SELECT stu_name FROM sys.stu_info WHERE stu_no=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql_check_query)) {
      echo("<script>window.alert('$error_message')</script>");
      echo ("<script>window.location = '成绩查询1.html'</script>");
      exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $stu_no);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if ($name == $row['stu_name']) {
                $sql_grade_query = "SELECT sub1_grade,sub2_grade,sub3_grade,sub4_grade,sub5_grade,sub6_grade,sub7_grade,sub8_grade,sub9_grade
                                    FROM sys.stu_grade WHERE stu_no=? ;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql_grade_query)) {
                  echo("<script>window.alert('$error_message')</script>");
                  echo ("<script>window.location = '成绩查询2.html'</script>");
                  exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $stu_no);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($row = mysqli_fetch_assoc($result)) {
                      foreach ($row as $key => $value) {
                        if ($value == null) {
                          $row[$key]= "未参与考试";
                        }
                      }
                        $grade1 = $row['sub1_grade'];
                        $grade2 = $row['sub2_grade'];
                        $grade3 = $row['sub3_grade'];
                        $grade4 = $row['sub4_grade'];
                        $grade5 = $row['sub5_grade'];
                        echo "<div id='subject'>
                                <h4 class='caption-query'>科目</h4>
                                <hr class='show-hr' />
                                <ul class='grade-ul'>
                                  <li>跳远</li>
                                  <li>长跑</li>
                                  <li>跳高</li>
                                  <li>身高</li>
                                  <li>体重</li>
                                </ul>
                              </div>
                              <div id='grade'>
                                    <h4 class='caption-query'>成绩</h4>
                                    <hr class='show-hr' />
                                    <ul class='grade-ul'>
                                      <li id='grade-1'>$grade1</li>
                                      <li id='grade-2'>$grade2</li>
                                      <li id='grade-3'>$grade3</li>
                                      <li id='grade-4'>$grade4</li>
                                      <li id='grade-5'>$grade5</li>
                                    </ul>
                              </div>";
                        exit();
                    }
                    else {
                      echo("<script>window.alert('$error_message')</script>");
                      echo ("<script>window.location = '成绩查询2.html'</script>");
                      exit();
                    }

                }
            }
             else if ($name != $row['stu_name']) {
               echo("<script>window.alert('$error_message')</script>");
               echo ("<script>window.location = '../成绩查询.html'</script>");
               exit();
             } else {
               echo("<script>window.alert('$error_message')</script>");
               echo ("<script>window.location = '../成绩查询.html'</script>");
               exit();
              }

        } else {
          echo("<script>window.alert('$error_message')</script>");
          echo ("<script>window.location = '../成绩查询.html'</script>");
          exit();
        }
    }
}
else {
  echo("<script>window.alert('$error_message')</script>");
  echo ("<script>window.location = '../成绩查询.html'</script>");
  exit();
}












//    if (empty($username) || empty($password)) {
//        header("location:login.html?error=emptyfields");
//        exit();
//    }
//    else {
//        $sql_select = "SELECT * FROM ceshi.login WHERE username=? OR email=?;";
//        $stmt = mysqli_stmt_init($conn);
//        if (!mysqli_stmt_prepare($stmt,$sql_select)){
//            header("location:login.html?error=sqlerror");
//            exit();
//        }
//        else {
//            mysqli_stmt_bind_param($stmt,"ss",$username,$username);
//            mysqli_stmt_execute($stmt);
//            $result = mysqli_stmt_get_result($stmt);
//            if ($row = mysqli_fetch_assoc($result)) {
//                $passwordcheck = password_verify($password,$row['password']);
//                if ($passwordcheck == false) {
//                    header("location:login.html?error=wrongpassword1");
//                    exit();
//                }
//                else if($passwordcheck == true) {
//                    session_start();
//                    $_SESSION['userID']=$row['id'];
//                    $_SESSION['username']=$row['username'];
//
//                    header("location:login.html?login=success");
//                    exit();
//                }
//                else {
//                    header("location:login.html?error=wrongpassword2");
//                    exit();
//                }
//            }
//            else {
//                header("location:login.html?error=nouserexist");
//                exit();
//            }
//        }
//    }
//
//}
//else {
//    header("location:login.html");
//    exit();
//}
