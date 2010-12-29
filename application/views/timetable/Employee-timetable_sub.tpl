<link rel='stylesheet' type='text/css' href='{$baseUrl}/css/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='{$baseUrl}/css/overlay.css' />
<link rel='stylesheet' type='text/css' href='{$baseUrl}/css/main.css' />
<link rel='stylesheet' type='text/css' href='{$baseUrl}/css/test.css' />
<script type='text/javascript' src='{$baseUrl}/js/jquery/jquery.tools.min.js'></script>
<script type='text/javascript' src='{$baseUrl}/js/jquery/fullcalendar.js'></script>
<script type='text/javascript' src='{$baseUrl}/js/jquery/employee-timetable/employee-timetable.js'></script>
<input id="schedule_type" value="{$schedule_type}" type="hidden">
<div align="center">
    <div id="datepicker"></div>
    <br/>
    <div align="center" id='calendar' style="width: 900px"></div>
</div>
<div id="overlay" class="overlay center">
    <div id="overlay_content">
        <table>
            <thead>
                <tr>
                    <td colspan="2"><h1>Actividad de Planilla</h1></td>
                </tr>
                <tr>
                    <td colspan="2" id="hours"></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="right">
                        Tipo de proyecto:
                    </td>
                    <td>
                        <select id="project_type">
                            <option value="0">Selecciona</option>
                            <option value="1">Específico</option>
                            <option value="2">Departamental</option>
                        </select>
                    </td>
                </tr>
                <tr id="projects_tr">
                    <td class="right">Proyecto:</td>
                    <td>
                        <select name="id_project" id="projects">

                        </select>
                    </td>
                </tr>
                <tr id="tasks_tr">
                    <td class="right">Actividad:</td>
                    <td>
                        <select name="id_project" id="tasks">

                        </select>
                    </td>
                </tr>
                <tr id="description_tr">
                    <td colspan="2">
                        Descripcion:<br/>
                        <textarea id="description"></textarea>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><input type="button" id="create" value="Crear Actividad"/></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div id="overlay_task" class="overlay center">
    <div id="overlay_content_task">
        <table>
            <thead>
                <tr>
                    <td colspan="2"><h1>Acciones de Actividad</h1></td>
                </tr>
                <tr>
                    <td colspan="2" id="hours"></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Actividad <label id="task_label"></label>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="button" id="delete" value="Eliminar Actividad"/>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>