_row.tpl

<tr>
    <td>{$email->getIdEmail()}</td>
    <td>{$email->getIdPerson()}</td>
    <td>{$email->getEmail()}</td>
    <td>{$email->getType()}</td>
    <td><a href="{url action=edit idEmail=$email->getIdEmail()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idEmail=$email->getIdEmail()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
