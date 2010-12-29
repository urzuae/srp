_row.tpl

<tr>
    <td>{$person->getIdPerson()}</td>
    <td>{$person->getName()}</td>
    <td>{$person->getMiddleName()}</td>
    <td>{$person->getLastName()}</td>
    <td>{$person->getBirthdate()}</td>
    <td>{$person->getSsn()}</td>
    <td>{$person->getGenre()}</td>
    <td>{$person->getMaritalStatus()}</td>
    <td>{$person->getCurp()}</td>
    <td>{$person->getNationality()}</td>
    <td>{$person->getIdFiscalEntity()}</td>
    <td><a href="{url action=edit idPerson=$person->getIdPerson()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idPerson=$person->getIdPerson()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
