<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Logout | Dashboard
    </title>
</head>
<body class="g-sidenav-show  bg-gray-100">
<script src="../assets/js/plugins/jquery.js"></script>
<script src="../assets/js/custom/dashboard-client.js"></script>
<script>
    DashboardClient.post(DashboardClient.domainUrl()+"/v1/logout")
        .then((response) => {
            if (response.status === true){
                DashboardHelper.destroyAccessToken();
                window.location.href = "../login.php";
            }
        })
        .catch((error) => {
            window.location.href = "../login.php";
            DashboardHelper.preLoaderHide();
            if(error.status === 401){
                DashboardHelper.unAuthorize();
            }
        })
</script>
</body>
</html>