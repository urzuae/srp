<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('Person')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='person/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdPerson')}</td>
            <td>{$i18n->_('Name')}</td>
            <td>{$i18n->_('MiddleName')}</td>
            <td>{$i18n->_('LastName')}</td>
            <td>{$i18n->_('Birthdate')}</td>
            <td>{$i18n->_('Ssn')}</td>
            <td>{$i18n->_('Genre')}</td>
            <td>{$i18n->_('MaritalStatus')}</td>
            <td>{$i18n->_('Curp')}</td>
            <td>{$i18n->_('Nationality')}</td>
            <td>{$i18n->_('IdFiscalEntity')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $persons as $person}
            <tr class="{$person@iteration|odd}">
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
        {/foreach}
    </tbody>
</table>

