DashboardHelper.authAliveDash()
DashboardHelper.preLoaderHide()
$(document).on("submit","#change_password",function (e){
    e.preventDefault()
    let loginData = DashboardHelper.serializeObject($(this));
    let postData = {
        current_password    : loginData.current_password,
        new_password: loginData.new_password,
        confirm_password: loginData.confirm_password
    }
    DashboardClient.post(DashboardClient.domainUrl()+"/v1/change_password", postData)
        .then((response) => {
            if (response.status === true){
                toastr.info(response.message, "info", DashboardHelper.toastOption());
                $(this).trigger("reset")
            }
        })
        .catch((error) => {
            if(error.status === 401){
                DashboardHelper.unAuthorize();
            }
            toastr.error(error.responseJSON.message, "error", DashboardHelper.toastOption());
        })
});

