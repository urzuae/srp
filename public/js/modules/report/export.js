$(function() {
    $("#idDept").change(function() {
        $("#idDept option:selected").each(function () {
            data = $(this).attr('value');
        });
        url = "/code/srp/public/export/employees/data/"+data;
        $.ajax({
            url: url,
            type: 'get',
            dataType: "json",
            success: function(response) {
                $("#idEmp").html("");
                $("#idEmp").append('<option>Selecciona un empleado</option>');
                for (var i=0; i<response.length; i++) {
                    emp = response[i];
                    idEmp = emp['idEmp'];
                    name = emp['name'];
                    $("#idEmp").append('<option value='+idEmp+'>'+name+'</option>');
                }
            }
        });
        return false;
    });
});
