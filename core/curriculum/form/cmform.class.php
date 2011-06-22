<?php
/**
 * ELIS(TM): Enterprise Learning Intelligence Suite
 * Copyright (C) 2008-2010 Remote-Learner.net Inc (http://www.remote-learner.net)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    elis
 * @subpackage curriculummanagement
 * @author     Remote-Learner.net Inc
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2008-2010 Remote Learner.net Inc http://www.remote-learner.net
 *
 */

require_once($CFG->dirroot . '/lib/formslib.php');

/**
 *
 * @staticvar bool $done
 */
function form_init_date_js() {
    global $PAGE, $CFG;
    static $done = false;
    if (!$done) {
        echo '<style type="text/css">';
        echo '@import "' . $CFG->httpswwwroot . '/lib/yui/assets/skins/sam/calendar.css";';
        echo '</style>';
        require_js(array('yui_dom-event', 'yui_yahoo', 'yui_event', ajax_get_lib('yui_calendar'), ajax_get_lib('yui_container')));
        require_js($CFG->wwwroot . '/curriculum/form/javascript-static.js');

        echo '<script type="text/javascript">init_date_selectors("' . get_string('firstdayofweek') . '");</script>';
        $done = true;
    }
}

class cmform extends moodleform {
    function definition() {
        if(!empty($this->_customdata['obj'])) {
            if (is_object($this->_customdata['obj']) && method_exists($this->_customdata['obj'], 'to_array')) {
                $this->set_data($this->_customdata['obj']->to_array());
            } else {
                $this->set_data($this->_customdata['obj']);
            }
        }
    }

    function freeze() {
        $this->_form->freeze();
    }

    function display() {
        parent::display();
        form_init_date_js();
    }
}

?>