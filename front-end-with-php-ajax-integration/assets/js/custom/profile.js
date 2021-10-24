(new Dashboard()).getProfile();


$("#profileModel").click(function (){
    (new Dashboard()).getName();
});
$("#getUserInfo").click(function (){
    (new Dashboard()).getUserInfo();
});
$(document).on("submit","#updateUser",function (e){
    e.preventDefault();
    let userData = DashboardHelper.serializeObject($(this));
    let postUserData = {
        name: userData.name,
        headline: userData.title
    }
    DashboardClient.put(DashboardClient.domainUrl() + "/v1/update/profile/headline", postUserData)
        .then((response) => {
            if (response.status === true) {
                 toastr.info(response.message, "info", DashboardHelper.toastOption());
                 $("#close_1").click();
                 $(this).trigger("reset");
                 (new Dashboard()).getProfile()
            }
        })
        .catch((error) => {
            toastr.error(error.responseJSON.message, "error", DashboardHelper.toastOption());
        })
})
$(document).on("submit","#updateUserInfo",function (e){
    e.preventDefault();
    let userData = DashboardHelper.serializeObject($(this));
    let postUserData = {
        name: userData.name,
        mobile: userData.mobile,
        description: userData.description,
        location: userData.location
    }
    DashboardClient.put(DashboardClient.domainUrl() + "/v1/update/profile/information", postUserData)
        .then((response) => {
            if (response.status === true) {
                 toastr.info(response.message, "info", DashboardHelper.toastOption());
                 $("#close_2").click();
                 $(this).trigger("reset");
                 (new Dashboard()).getProfile()
            }
        })
        .catch((error) => {
            toastr.error(error.responseJSON.message, "error", DashboardHelper.toastOption());
        })
})


let postData = {
    setting_name: null,
    setting_value: null
}
$(document).on("change", "#email_follow_me", function () {
    postData.setting_name = "email_follow_me";
    postData.setting_value = $(this).is(":checked") ? 1 : 0;
    (new Dashboard()).updateSetting();
})
$(document).on("change", "#email_answers_my_post", function () {
    postData.setting_name = "email_answers_my_post";
    postData.setting_value = $(this).is(":checked") ? 1 : 0;
    (new Dashboard()).updateSetting();
})
$(document).on("change", "#email_someone_mentions_me", function () {
    postData.setting_name = "email_someone_mentions_me";
    postData.setting_value = $(this).is(":checked") ? 1 : 0;
    (new Dashboard()).updateSetting();
})
$(document).on("change", "#new_launches_projects", function () {
    postData.setting_name = "new_launches_projects";
    postData.setting_value = $(this).is(":checked") ? 1 : 0;
    (new Dashboard()).updateSetting();
})
$(document).on("change", "#monthly_product_updates", function () {
    postData.setting_name = "monthly_product_updates";
    postData.setting_value = $(this).is(":checked") ? 1 : 0;
    (new Dashboard()).updateSetting();
})
$(document).on("change", "#subscribe_to_newsletter", function () {
    postData.setting_name = "subscribe_to_newsletter";
    postData.setting_value = $(this).is(":checked") ? 1 : 0;
    (new Dashboard()).updateSetting();
})
function Dashboard() {
    this.getProfile = () => {
        DashboardClient.get(DashboardClient.domainUrl() + "/v1/profile")
            .then((response) => {
                if (response.status === true) {
                    let data = response.data;

                    $('#h_name').html(data.name ? data.name : 'N/A')
                    $('#headline').html(data.title ? data.title : 'N/A')
                    $('#description').html(data.description ? data.description : 'N/A')
                    $('#name').html(data.name ? data.name : 'N/A')
                    $('#mobile').html(data.mobile ? data.mobile : 'N/A')
                    $('#email').html(data.email ? data.email : 'N/A')
                    $('#location').html(data.location ? data.location : 'N/A')

                    if (data.email_follow_me == 1) {
                        $('#email_follow_me').prop('checked', true)
                    } else {
                        $('#email_follow_me').prop('checked', false)
                    }
                    if (data.email_answers_my_post == 1) {
                        $('#email_answers_my_post').prop('checked', true)
                    } else {
                        $('#email_answers_my_post').prop('checked', false)
                    }
                    if (data.email_someone_mentions_me == 1) {
                        $('#email_someone_mentions_me').prop('checked', true)
                    } else {
                        $('#email_someone_mentions_me').prop('checked', false)
                    }
                    if (data.new_launches_projects == 1) {
                        $('#new_launches_projects').prop('checked', true)
                    } else {
                        $('#new_launches_projects').prop('checked', false)
                    }
                    if (data.monthly_product_updates == 1) {
                        $('#monthly_product_updates').prop('checked', true)
                    } else {
                        $('#monthly_product_updates').prop('checked', false)
                    }
                    if (data.subscribe_to_newsletter == 1) {
                        $('#subscribe_to_newsletter').prop('checked', true)
                    } else {
                        $('#subscribe_to_newsletter').prop('checked', false)
                    }
                }
                DashboardHelper.preLoaderHide();
            })
            .catch((error) => {
                if(error.status === 401){
                    DashboardHelper.unAuthorize();
                }
                DashboardHelper.preLoaderHide();
                console.log(error.responseJSON)
            })
    };
    this.getName = () => {
        DashboardClient.get(DashboardClient.domainUrl() + "/v1/profile")
            .then((response) => {
                if (response.status === true) {
                    let data = response.data;
                    $("#fname").val(data.name)
                    $("#ftitle").val(data.title)
                }
            })
            .catch((error) => {
                console.log(error.responseJSON)
            })
    };
    this.getUserInfo = () => {
        DashboardClient.get(DashboardClient.domainUrl() + "/v1/profile")
            .then((response) => {
                if (response.status === true) {
                    let data = response.data;
                    console.log(data)
                    $("#infoName").val(data.name)
                    $("#infoDescription").val(data.description)
                    $("#infoMobile").val(data.mobile)
                    $("#infoEmail").val(data.email)
                    $("#infoLocation").val(data.location)
                }
            })
            .catch((error) => {
                console.log(error.responseJSON)
            })
    };
    this.updateSetting = () => {
        DashboardClient.post(DashboardClient.domainUrl() + "/v1/update/setting", postData)
            .then((response) => {
                if (response.status === true) {
                    toastr.info(response.message, "info", DashboardHelper.toastOption());
                }
            })
            .catch((error) => {
                toastr.error(error.responseJSON.message, "error", DashboardHelper.toastOption());
            })
    };
}