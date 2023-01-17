function showHidePwd() {
    const oko = document.getElementById("icpwd");
    const pwd = document.getElementById("pwd");

    if (pwd.type === "password") {
        pwd.type = "text";
        oko.className = "fa-regular fa-eye-slash fa-lg";
    } else {
        pwd.type = "password";
        oko.className = "fa-regular fa-eye fa-lg";
    }
}

function showHidePwdReg() {
    const pwd1 = document.getElementsByName("password")[0];
    const pwd2 = document.getElementsByName("passwordRepeat")[0];
    const oko = document.getElementById("aa");
    const okoa = document.getElementById("bb");

    if (pwd1.type === "password" || pwd2.type === "password") {
        pwd1.type = "text";
        pwd2.type = "text";
        oko.className = "fa-regular fa-eye-slash fa-lg";
        okoa.className = "fa-regular fa-eye-slash fa-lg";
    } else {
        pwd1.type = "password";
        pwd2.type = "password";
        oko.className = "fa-regular fa-eye fa-lg";
        okoa.className = "fa-regular fa-eye fa-lg";
    }
}

function heslaZhoda() {
    const pwd1 = document.getElementsByName("password")[0];
    const pwd2 = document.getElementsByName("passwordRepeat")[0];
    const hesla = document.getElementById("hesla");
    const button = document.getElementById("submit-reg");

    if (pwd1.value !== "" && pwd2.value !== "") {
        if (pwd1.value !== pwd2.value) {
            hesla.innerHTML = "Hesla sa nezhoduju!!";
            hesla.className = "text-danger";
            button.disabled = true;
        } else {
            hesla.innerHTML = "Hesla sa zhoduju!!";
            hesla.className = "text-success";
            button.disabled = false;
        }
    }
}

function showForm() {
    const form = document.getElementById("formPridaj");
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}