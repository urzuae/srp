<tr>
    <th>{$i18n->_('id_person')}</th>
    <td># {$post['id_person']}<input type="hidden" name="id_person" id="id_person" value="{$post['id_person']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('id_fiscal_entity')}</th>
    <td>{html_options name=id_fiscal_entity id=id_fiscal_entity options=$FiscalEntitys selected=$post['id_fiscal_entity'] }</td>
</tr>
<tr>
    <th>{$i18n->_('name')}</th>
    <td><input type="text" name="name" id="name" value="{$post['name']}" class="" /></td>
</tr>
<tr>
    <th>{$i18n->_('middle_name')}</th>
    <td><input type="text" name="middle_name" id="middle_name" value="{$post['middle_name']}" class="" /></td>
</tr>
<tr>
    <th>{$i18n->_('last_name')}</th>
    <td><input type="text" name="last_name" id="last_name" value="{$post['last_name']}" class="" /></td>
</tr>
<tr>
    <th>{$i18n->_('birthdate')}</th>
    <td><input type="text" name="birthdate" id="birthdate" value="{$post['birthdate']}" class="datePicker dateISO" /></td>
</tr>
<tr>
    <th>{$i18n->_('ssn')}</th>
    <td><input type="text" name="ssn" id="ssn" value="{$post['ssn']}" class="" /></td>
</tr>
<tr>
    <th>{$i18n->_('genre')}</th>
    <td><input type="text" name="genre" id="genre" value="{$post['genre']}" class="number" /></td>
</tr>
<tr>
    <th>{$i18n->_('marital_status')}</th>
    <td><input type="text" name="marital_status" id="marital_status" value="{$post['marital_status']}" class="number" /></td>
</tr>
<tr>
    <th>{$i18n->_('curp')}</th>
    <td><input type="text" name="curp" id="curp" value="{$post['curp']}" class="" /></td>
</tr>
<tr>
    <th>{$i18n->_('nationality')}</th>
    <td><input type="text" name="nationality" id="nationality" value="{$post['nationality']}" class="" /></td>
</tr>

<!--
$idPerson = $this->getRequest()->getParam('id_person');
$name = $this->getRequest()->getParam('name');
$middleName = $this->getRequest()->getParam('middle_name');
$lastName = $this->getRequest()->getParam('last_name');
$birthdate = $this->getRequest()->getParam('birthdate');
$ssn = $this->getRequest()->getParam('ssn');
$genre = $this->getRequest()->getParam('genre');
$maritalStatus = $this->getRequest()->getParam('marital_status');
$curp = $this->getRequest()->getParam('curp');
$nationality = $this->getRequest()->getParam('nationality');
$idFiscalEntity = $this->getRequest()->getParam('id_fiscal_entity');
-->

<!--
$post = array(
    'id_person' => $person->getIdPerson(),
    'name' => $person->getName(),
    'middle_name' => $person->getMiddleName(),
    'last_name' => $person->getLastName(),
    'birthdate' => $person->getBirthdate(),
    'ssn' => $person->getSsn(),
    'genre' => $person->getGenre(),
    'marital_status' => $person->getMaritalStatus(),
    'curp' => $person->getCurp(),
    'nationality' => $person->getNationality(),
    'id_fiscal_entity' => $person->getIdFiscalEntity(),
);
-->
