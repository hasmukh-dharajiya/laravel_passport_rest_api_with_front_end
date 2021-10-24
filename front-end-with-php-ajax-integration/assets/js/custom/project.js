DashboardHelper.preLoaderShow();
(new Dashboard()).getProject();
let postDataAdd = {
    name: null,
    budget: null,
    responsible_user: null,
    status: null
}
let postDataEdit = {
    id: null,
    name: null,
    budget: null,
    responsible_user: null,
    status: null
}
$(document).on("submit", "#addProjectForm", function (e) {
    e.preventDefault();
    let projectData = DashboardHelper.serializeObject($(this));
    postDataAdd.name = projectData.project_name;
    postDataAdd.budget = projectData.budget;
    postDataAdd.responsible_user = projectData.user_responsible;
    postDataAdd.status = projectData.status;
    (new Dashboard()).addProject();
})
$(document).on("submit", "#updateProjectForm", function (e) {
    e.preventDefault();
    let projectData = DashboardHelper.serializeObject($(this));
    postDataEdit.name = projectData.project_name;
    postDataEdit.budget = projectData.budget;
    postDataEdit.responsible_user = projectData.user_responsible;
    postDataEdit.status = projectData.status;
    (new Dashboard()).updateProject();
})
function Dashboard() {
    this.getProject = () => {
        $("#showProject").html('')
        DashboardClient.get(DashboardClient.domainUrl() + "/v1/projects")
            .then((response) => {
                if (response.status === true) {
                    let data = response.data;
                    $.each(data, function (key, val) {
                        let status_value = "Incomplete";
                        let status_color = "secondary";
                        if (val.status == 1) {
                            status_value = "Complete";
                            status_color = "success";
                        }
                        $("#showProject").append(`
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
                                        <span class="text-xs font-weight-bold">${val.responsible_user ? val.responsible_user : '--'}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-${status_color ? status_color : status_color}">${status_value ? status_value : '--'}</span>                                       
                                    </td>                                   
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">${val.created_at ? val.created_at : '--'}</span>
                                        </div>
                                    </td>
                                    <td>
                                    <div data-toggle="modal" data-target="#editProject" style="display: inline">
                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript: editProject(${val.id});"  ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i></a>
                                    </div>                                                                              
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript: deleteProject(${val.id});"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                        `);
                    });
                }
                DashboardHelper.preLoaderHide();
            })
            .catch((error) => {
                $("#showProject").html(`
                            <tr class="text-center">
                                <td colspan="10" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Data Not Fount...</td>
                            </tr>
                        `);
                if(error.status === 401){
                    DashboardHelper.unAuthorize();
                }
                console.log(error.responseJSON)
                DashboardHelper.preLoaderHide();
            })
    };
    this.addProject = () => {
        console.log(postDataAdd)
        DashboardClient.post(DashboardClient.domainUrl() + "/v1/add/project", postDataAdd)
            .then((response) => {
                if (response.status === true) {
                    toastr.info(response.message, "info", DashboardHelper.toastOption());
                    $("#close_1").click();
                    $(this).trigger("reset")
                    (new Dashboard().getProject());
                }
            })
            .catch((error) => {
                toastr.error(error.responseJSON.message, "error", DashboardHelper.toastOption());
            })
    };
    this.updateProject = () => {
        console.log(postDataEdit)
        DashboardClient.put(DashboardClient.domainUrl() + "/v1/update/project", postDataEdit)
            .then((response) => {
                if (response.status === true) {
                    toastr.info(response.message, "info", DashboardHelper.toastOption());
                    $("#close_2").click();
                    $(this).trigger("reset")
                    (new Dashboard().getProject());
                }
            })
            .catch((error) => {
                toastr.error(error.responseJSON.message, "error", DashboardHelper.toastOption());
            })
    };
    this.deleteProject = (id) => {
        console.log(id)
        DashboardClient.delete(DashboardClient.domainUrl() + "/v1/delete/project/" + id)
            .then((response) => {
                if (response.status === true) {
                    toastr.info(response.message, "info", DashboardHelper.toastOption());
                    (new Dashboard()).getProject();
                }
            })
            .catch((error) => {
                toastr.error(error.responseJSON.message, "error", DashboardHelper.toastOption());
            })
    };
    this.getProjectById = (id) => {
        DashboardClient.get(DashboardClient.domainUrl() + "/v1/get/project/" + id)
            .then((response) => {
                if (response.status === true) {
                    let data = response.data;
                    $("#edit_name").val(data.name)
                    $("#edit_budget").val(data.budget)
                    $("#edit_user_responsible").val(data.responsible_user)
                    $('#edit_ststus').find('option[value=' + data.status + ']').attr("selected", true);
                }
            })
            .catch((error) => {
                console.log(error.responseJSON)
            })
    };
}
function editProject(id) {
    postDataEdit.id = id;
    (new Dashboard()).getProjectById(id);
}
function deleteProject(id) {
    (new Dashboard()).deleteProject(id);
}