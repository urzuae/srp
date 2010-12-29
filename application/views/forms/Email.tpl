<tr>
    <th>{$i18n->_('id_email')}</th>
    <td># {$post['id_email']}<input type="hidden" name="id_email" id="id_email" value="{$post['id_email']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('id_person')}</th>
    <td>{html_options name=id_person id=id_person options=$Persons selected=$post['id_person'] }</td>
</tr>
<tr>
    <th>{$i18n->_('email')}</th>
    <td><input type="text" name="email" id="email" value="{$post['email']}" class=" required" /></td>
</tr>
<tr>
    <th>{$i18n->_('type')}</th>
    <td><input type="text" name="type" id="type" value="{$post['type']}" class="number" /></td>
</tr>

<!--
$idEmail = $this->getRequest()->getParam('id_email');
$idPerson = $this->getRequest()->getParam('id_person');
$email = $this->getRequest()->getParam('email');
$type = $this->getRequest()->getParam('type');
-->

<!--
$post = array(
    'id_email' => $email->getIdEmail(),
    'id_person' => $email->getIdPerson(),
    'email' => $email->getEmail(),
    'type' => $email->getType(),
);
-->
