DashboardHelper.preLoaderShow();
(new Dashboard()).getDashboard();
function Dashboard() {
    this.getDashboard = () => {
        DashboardClient.get(DashboardClient.domainUrl()+"/v1/dashboard")
            .then((response) => {
                if (response.status === true){
                    $("#total_project").html(response.data.totalProject)
                    $("#total_task").html(response.data.totalTask)
                    $("#total_complete_project").html(response.data.completeProject)
                    $("#total_complete_task").html(response.data.completeTask)
                    $.each(response.data.Project, function (key,val){
                        let status_value = "Incomplete";
                        let status_color = "secondary";
                        if (val.status == 1){
                            status_value = "Complete";
                            status_color = "success";
                        }
                        $("#projectData").append(`
                            <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">${val.id ? val.id : '--'}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">${val.name ? val.name : '--'}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">${val.budget ? val.budget : '--'}</p>
                                    </td>     
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">${val.responsible_user ? val.responsible_user : '--'}</p>
                                    </td>     
                                                                  
                                    <td class="text-sm text-center">
                                        <span class="badge badge-sm bg-gradient-${status_color ? status_color : status_color}">${status_value ? status_value : '--'}</span>                                       
                                    </td>
                                   
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">${val.created_at ? val.created_at : '--'}</span>
                                        </div>
                                    </td>
                                </tr>
                        `);
                    })
                    $.each(response.data.task, function (key,val){
                        let status_value = "Incomplete";
                        let status_color = "secondary";
                        if (val.status == 1){
                            status_value = "Complete";
                            status_color = "success";
                        }
                        $("#taskData").append(`                                                                                            
                            <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">${val.id ? val.id : '--'}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">${val.name ? val.name : '--'}</h6>
                                            </div>
                                        </div>
                                    </td>                                   
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">${val.responsible_user ? val.responsible_user : '--'}</p>
                                    </td>     
                                                                  
                                    <td class="text-sm text-center">
                                        <span class="badge badge-sm bg-gradient-${status_color ? status_color : status_color}">${status_value ? status_value : '--'}</span>                                       
                                    </td>
                                   
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">${val.due_date ? val.due_date : '--'}</span>
                                        </div>
                                    </td>
                                </tr>
                        `);
                    })
                    DashboardHelper.preLoaderHide();
                }
            })
            .catch((error) => {
                DashboardHelper.preLoaderHide();
                console.log(error.responseJSON)
                if(error.status === 401){
                    DashboardHelper.unAuthorize();
                }
            })
    };
}