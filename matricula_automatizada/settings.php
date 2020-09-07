<?php


defined('MOODLE_INTERNAL') || die();




if ($hassiteconfig) {
    // Needs this condition or there is error on login page.
    $ADMIN->add('root', new admin_externalpage('matricula_automatizada',
            get_string('pluginname', 'tool_matricula_automatizada'),
            new moodle_url('/admin/tool/matricula_automatizada/index.php')));
}

