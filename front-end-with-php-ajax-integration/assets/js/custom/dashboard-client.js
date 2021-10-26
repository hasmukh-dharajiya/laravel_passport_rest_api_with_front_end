const DashboardClient = {
    post(url, postData = []) {
        this.csrf();
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'post',
                data: postData,
                headers: {'Authorization': 'Bearer ' + DashboardHelper.getAccessToken()}
            }).done(response => {
                resolve(response);
            }).fail(error => {
                reject(error);
            });
        });
    },
    get(url, jsonData = []) {
        if(jsonData.length > 0) {
            url += '?' +
                Object.keys(jsonData).map(function(key) {
                    return encodeURIComponent(key) + '=' +
                        encodeURIComponent(jsonData[key]);
                }).join('&');
        }
        this.csrf();
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'get',
                headers: {'Authorization': 'Bearer ' + DashboardHelper.getAccessToken()}
            }).done(response => {
                resolve(response);
            }).fail(error => {
                reject(error);
            });
        });
    },
    put(url, postData = []) {
        this.csrf();
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'put',
                data: postData,
                headers: {'Authorization': 'Bearer ' + DashboardHelper.getAccessToken()}
            }).done(response => {
                resolve(response);
            }).fail(error => {
                reject(error);
            });
        });
    },
    delete(url, jsonData = []) {
        if(jsonData.length > 0) {
            url += '?' +
                Object.keys(jsonData).map(function(key) {
                    return encodeURIComponent(key) + '=' +
                        encodeURIComponent(jsonData[key]);
                }).join('&');
        }
        this.csrf();
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: url,
                method: 'delete',
                headers: {'Authorization': 'Bearer ' + DashboardHelper.getAccessToken()}
            }).done(response => {
                resolve(response);
            }).fail(error => {
                reject(error);
            });
        });
    },
    csrf() {
        return $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    },
    domainUrl(){
        return "http://127.0.0.1:8000/api";
    },
}
const DashboardHelper = {
    serializeObject: (data) => {
        let o = {};
        let a = data.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    },
    blockUi: (bloclEl) => {
        if(Array.isArray(bloclEl)) {
            console.log(bloclEl)
            bloclEl.forEach((item) => {
                console.log(item)
                $(item).block({
                    message: '<div class="ft-refresh-cw font-medium-2"><i class="mdi mdi-clock-fast fa-spin"></i> <span style="font-size: 12px;font-weight: 600;">Please Wait...</span></div>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            });
        } else {
            $(bloclEl).block({
                message: '<div class="ft-refresh-cw font-medium-2"><i class="fa fa-circle-o-notch fa-spin"></i> <span style="font-size: 12px;font-weight: 600;">Please Wait...</span></div>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        }

    },
    unblockUi: (bloclEl) => {
        if(Array.isArray(bloclEl)) {
            bloclEl.forEach((item) => {
                $(item).unblock();
            });
        } else {
            $(bloclEl).unblock();
        }
    },
    toastOption : () => {
        return {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "10000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
        };

    },
    setAccessToken: (token) =>{
        localStorage.setItem("access_token",token)
    },
    getAccessToken: () =>{
        if (localStorage.getItem('access_token')){
            return localStorage.getItem('access_token')
        }else {
            return null
        }
    },
    preLoaderShow(){
        $('.preloader').fadeOut('slow');
    },
    preLoaderHide(){
        $('.preloader').fadeOut('hide');
    },
    unAuthorize(){
        window.location.href = '../login.php';
    },
    authAlive(){
        DashboardClient.get(DashboardClient.domainUrl()+"/v1/auth_alive")
            .then((response) => {
                if (response.status === true){
                    window.location.href = "user/";
                }
            })
            .catch((error) => {})
    },
    authAliveDash(){
        DashboardClient.get(DashboardClient.domainUrl()+"/v1/auth_alive")
            .then((response) => {
                if (response.status === false){
                    window.location.href = "login.php";
                }
            })
            .catch((error) => {

            })
    },
    destroyAccessToken: () =>{
        localStorage.removeItem('access_token');
    },
};