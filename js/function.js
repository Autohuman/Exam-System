$(document).ready(function(){
    $('.Dropdownu-btn').bind("input propertychange",function() {
        $('.Dropdownul').toggleClass('active')
    });
    $('#truename').bind("input propertychange",function(){
        namecheckfunc();
    });
    $('#idnum').bind("input propertychange",function(){
        idcheckfunc();
    });
    $('#tel').bind("input propertychange",function(){
        telcheckfunc();
    });
    $('#email').bind("input propertychange",function(){
        emailcheckfunc();
    });
    $('#school').bind("input propertychange",function(){
        schoolcheckfunc();
    });
    $("#form-submit").click(function(event) {
        event.preventDefault();
        if (pass && namecheck && telcheck&&emailcheck&&schoolcheck) {
            $("form").submit();
        }else {
            document.querySelector("#checkinfo").innerHTML = "Error Exists,Please Re-Enter!";
            if (!pass) {
                $("#idnum").attr("value","");
            }
            if (!namecheck){
                $("#truename").attr("value","");
            }
            if (!telcheck){
                $("#tel").attr("value","");
            }
            if (!emailcheck){
                $("#email").attr("value","");
            }
        }
    });
});

addEventListener("load", function () {
    setTimeout(hideURLbar, 0);
}, false);

function hideURLbar() {
    window.scrollTo(0, 1);
}









let pass = "";
let namecheck = "";
let telcheck = "";
let emailcheck = "";
let schoolcheck = "";


//身份证号验证函数
function idcheckfunc() {
    let code = document.getElementById('idnum').value.toUpperCase();
    let length = code.length;
    let city = {
        11: "北京",
        12: "天津",
        13: "河北",
        14: "山西",
        15: "内蒙古",
        21: "辽宁",
        22: "吉林",
        23: "黑龙江 ",
        31: "上海",
        32: "江苏",
        33: "浙江",
        34: "安徽",
        35: "福建",
        36: "江西",
        37: "山东",
        41: "河南",
        42: "湖北 ",
        43: "湖南",
        44: "广东",
        45: "广西",
        46: "海南",
        50: "重庆",
        51: "四川",
        52: "贵州",
        53: "云南",
        54: "西藏 ",
        61: "陕西",
        62: "甘肃",
        63: "青海",
        64: "宁夏",
        65: "新疆",
        71: "台湾",
        81: "香港",
        82: "澳门",
        91: "国外 "
    };
    let tip = "";
    let patt15 = new RegExp("^[1-9]\\d{5}\\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\\d{2}$");
    let patt18 = new RegExp("^[1-9]\\d{5}(18|19|([23]\\d))\\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\\d{3}[0-9Xx]$");

    if (code == null) {
        tip = "Error";
        document.getElementById("checkinfo1").innerHTML = tip;
        pass = false;
    }
    else if (length != 18 && length != 15) {
        tip = "Error";
        document.getElementById("checkinfo1").innerHTML = tip;
        pass = false;
    }
    else if (length == 15) {
        if (!patt15.test(code)) {
            tip = "Error";
            document.getElementById("checkinfo1").innerHTML = tip;
            pass = false;
        }
        else if (!city[code.substr(0, 2)]) {
            tip = "Error";
            document.getElementById("checkinfo1").innerHTML = tip;
            pass = false;
        }
        else {
            tip = "Success";
            document.getElementById("checkinfo1").innerHTML = tip;
            document.getElementById("checkinfo1").style.color = "green";
            pass = false;
        }
    }
    else if (length == 18) {
        if (!patt18.test(code)) {
            tip = "Error";
            document.getElementById("checkinfo1").innerHTML = tip;
            pass = false;
        }
        else if (!city[code.substr(0, 2)]) {
            tip = "Error";
            document.getElementById("checkinfo1").innerHTML = tip;
            pass = false;
        }
        else {
            code = code.split('');
            //∑(ai×Wi)(mod 11)
            //加权因子
            let factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
            //校验位
            let parity = [1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2];
            let sum = 0;
            let ai = 0;
            let wi = 0;
            for (var i = 0; i < 17; i++) {
                ai = code[i];
                wi = factor[i];
                sum += ai * wi;
            }
            let last = parity[sum % 11];
            if (last != code[17]) {
                tip = "Error";
                document.getElementById("checkinfo1").innerHTML = tip;
                pass = false;
            }
            else {
                tip = "Success";
                document.getElementById("checkinfo1").innerHTML = tip;
                document.getElementById("checkinfo1").style.color = "green";
                pass = true;
            }
        }
    }
    else {
        tip = "Error";
        document.getElementById("checkinfo1").innerHTML = tip;
        pass = false;
    }
}

//姓名验证函数
function namecheckfunc() {
    let v = document.querySelector("#truename").value;
    let pattern = /^[\u4E00-\u9FA5]{2,10}(?:·[\u4E00-\u9FA5]{2,10})*$/i;
    if (pattern.test(v)) {
        namecheck = true;
        document.getElementById("checkinfo2").innerHTML = "Success";
        document.getElementById("checkinfo2").style.color = "green";
    } else {
        namecheck = false;
        document.getElementById("checkinfo2").innerHTML = "Error";
    }
}


//电话验证函数
function telcheckfunc() {
    let obj = document.querySelector("#tel");
    let tel_value = obj.value;
    let telreg=/^[1][34578][0-9]{9}$/;
    if (!telreg.test(tel_value)) {
        document.querySelector("#checkinfo3").innerHTML = "Error";
        telcheck = false;
    }
    else {
        document.querySelector("#checkinfo3").innerHTML = "Success";
        document.querySelector("#checkinfo3").style.color = "green";
        telcheck = true;
    }
}

//邮箱验证函数
function emailcheckfunc(){
    let emailValue = document.querySelector("#email").value;
    let emailReg = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/;
    if(!emailReg.test(emailValue)){
        document.querySelector("#checkinfo5").innerHTML = "Error";
        emailcheck = false;
    }
    else {
        document.querySelector("#checkinfo5").innerHTML = "Success";
        document.querySelector("#checkinfo5").style.color = "green";
        emailcheck = true;
    }
}

//学校选择验证
function schoolcheckfunc(){
    let schoolValue = document.querySelector("#school").value;
    if (schoolValue == null || schoolValue == 'School'){
        document.querySelector("#checkinfo6").innerHTML = "No Chosen";
        schoolcheck = false;
    }
    else{
        document.querySelector("#checkinfo6").innerHTML = "Success";
        document.querySelector("#checkinfo6").style.color = "green";
        schoolcheck = true;
    }
}
