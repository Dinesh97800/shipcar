$(document).ready(function () {
  var itemId;
  var statusElement;
  var type;
  var status;
  $("body").on("click", ".updateStatus", function (e) {
    e.preventDefault();
    statusElement = $(this);
    status = $(this).data("status");
    itemId = $(this).data("id");
    type = $(this).data("type");
    $("#statusConfirmModal").modal("show");
  });

  $("#confirmStatusChange").click(function () {
    $("#statusConfirmModal").modal("hide");
    $("#loader").removeClass("d-none");
    $.ajax({
      url: `${ajaxUrl}Api/admin/change-status.php`,
      method: "POST",
      data: {
        id: itemId,
        status: status,
        type: type,
      },
      success: function (resp) {
        console.log(resp)
        let response = JSON.parse(resp);
        console.log(typeof response,{response})
        $("#loader").addClass("d-none");
        if (response.status) {
          statusElement.text("active");
        //   statusElement.removeClass().addClass("active-btn");
          setTimeout(() => {
            location.reload();
          }, 500);
        } else {
          alert("Failed to update status");
        }
      },
      error: function (error) {
        console.log(error);
        $("#loader").addClass("d-none");
        // alert('Error occurred while updating status');
        statusElement.text("active");
        // statusElement.removeClass().addClass("btn-");
        setTimeout(() => {
          location.reload();
        }, 500);
      },
    });
  });
});
