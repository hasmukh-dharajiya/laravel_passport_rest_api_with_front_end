DashboardHelper.authAlive()
$(document).on("submit","#login",function (e){
    e.preventDefault()
    let loginData = DashboardHelper.serializeObject($(this));
    let postData = {
        email: loginData.email,
        password: loginData.password
    }

    DashboardClient.post(DashboardClient.domainUrl()+"/v1/login", postData)
        .then((response) => {
            if (response.status === true){
                DashboardHelper.setAccessToken(response.token);
                toastr.info(response.message, "info", DashboardHelper.toastOption());
                window.location.href = "user/index.php";
            }
        })
        .catch((error) => {
            toastr.error(error.responseJSON.message, "error", DashboardHelper.toastOption());
        })
});