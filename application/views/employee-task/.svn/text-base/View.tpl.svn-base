{literal}
<script type="text/javascript">
	var days_status_2={/literal}{$daysStaus2}{literal}
	var days_status_3={/literal}{$daysStaus3}{literal}
	var days_status_4={/literal}{$daysStaus4}{literal}
	var days_status_1={/literal}{$daysStaus1}{literal}
	var projects={/literal}{$projects}{literal}
</script>
{/literal}
<script type="text/javascript" src="{$baseUrl}/js/jquery/grid.locale-es.js"></script>
<script type="text/javascript" src="{$baseUrl}/js/jquery/jquery.jqGrid.min.js"></script>
<script type="text/javascript" src="{$baseUrl}/js/jquery/employee-task/calendar-task.js"></script>
<link rel="stylesheet" href="{$baseUrl}/css/test.css" type="text/css" />
<link rel="stylesheet" href="{$baseUrl}/css/ui.jqgrid.css" type="text/css" />
<h2>{$name}</h2>
<form action="{url action=list}" method="post">
    <input type="hidden" name="idEmployee" value="{$idEmployee}">
    
	<table class="center">
        <caption>{$l10n->_('Calendario de Tareas')}</caption>
        <tfoot>
            <tr>
                <td colspan="2">
                   <!-- <input type="button" value="{$l10n->_('Regresar')}" class="back" />-->
                </td>
            </tr>
        </tfoot>
        <tbody>
        	<tr>
                <td>
        			<div type="text" id="datepicker"></div>
        		</td>
        		<td>
        			<div id="mensaje"></div>
        		</td>
            </tr>
        </tbody>
    </table>
</form>
<hr>
<div class="center">
	<table id="list"></table>
	<div id="pager"></div> 
</div>