<?php
class user_mailman_register_handler_field_mail extends views_handler_field {
  function option_definition() {
    $options = parent::option_definition();
    $options['link_to_email'] = array('default' => 'mailto');
    return $options;
  }

  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    $form['link_to_email'] = array(
      '#title' => t('Link this field'),
      '#type' => 'radios',
      '#options' => array(
        0 => t('No link'),
        'mailto' => t("With a mailto:"),
      ),
      '#default_value' => $this->options['link_to_email'],
    );
  }

  function render($values) {
    if ($this->options['link_to_email'] == 'mailto') {
      return l($values->{$this->field_alias}, "mailto:" . $values->{$this->field_alias});
    }
    return check_plain($values->{$this->field_alias});
  }
}
