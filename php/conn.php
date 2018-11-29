<?php
//连接数据库
    header("Content-type: text/html; charset=utf-8");//设置编码
    $conn_host="localhost";
    $conn_schema="sys";
    $conn_username="root";
    $conn_password="";
    $conn=mysqli_connect("$conn_host","$conn_username","$conn_password","$conn_schema")
    or die("无法连接到数据库".mysqli_error($conn));
if (!$conn){
    die("连接失败：".mysqli_connect_error());
}
    mysqli_query($conn,"set names utf8");
