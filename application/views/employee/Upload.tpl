{if $warning_files != ""}
    <b> AVISO: {$warning_files}<b><br/>
 {/if}
<h3>{$ok_rows_count} {if $ok_rows_count > 1} registros procesados{else} registro procesado{/if} de {$rows_count}</h3><br/>
<b>Errores ({$reported_rows_count})</b>
{if $reported_rows_count > 0}
<table id="errors" class="center costum_form" style="width:100%;">
    <thead>
        <tr>
            <td>Linea</td>
            <td>Error</td>
        </tr>
    </thead>
    <tbody>
    {foreach from=$reported_rows key=myId item=i}
        <tr>
            <td style="vertical-align: top">
                {$myId}
            </td>
            <td>
                {$i.ERROR}
            </td>
        </tr>
    {/foreach}
    </tbody>
{/if}
</table>
<br/>
<b>Avisos ({$db_errors_count})</b>
{if $db_errors > 0}
<table id="warnings" class="center costum_form" style="width:100%;">
    <thead>
        <tr>
            <td>Linea</td>
            <td>Aviso</td>
        </tr>
    </thead>
    <tbody>
    {foreach from=$db_errors key=myId item=i}
        <tr>
            <td style="vertical-align: top">
                {$myId}
            </td>
            <td>
                {$i}
            </td>
        </tr>
    {/foreach}
    </tbody>
{/if}
</table>
<br/>
<br/>
<b>Formato CSV(Líneas incorrectas)</b>
{if $csv_lines > 0}
<table id="warnings" class="center costum_form" style="width:100%;">
    <thead>
        <tr>
            <td>Linea</td>
        </tr>
    </thead>
    <tbody>
    {foreach from=$csv_lines key=myId item=i}
        <tr>
            <td>
                {$i}
            </td>
        </tr>
    {/foreach}
    </tbody>
{/if}
</table>