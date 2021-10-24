DashboardHelper.authAlive()
$(document).on("submit", "#register", function (e) {
    e.preventDefault()
    let loginData = DashboardHelper.serializeObject($(this));
    let postData = {
        name: loginData.name,
        email: loginData.email,
        password: loginData.password,
    }

    DashboardClient.post(DashboardClient.domainUrl() + "/v1/register", postData)
        .then((response) => {
            if (response.status === true) {
                DashboardHelper.setAccessToken(response.token);
                toastr.info(response.message, "info", DashboardHelper.toastOption());
                window.location.href = "user/index.php";
            }
        })
        .catch((error) => {
            toastr.error(error.responseJSON.message, "error", DashboardHelper.toastOption());
        })
});