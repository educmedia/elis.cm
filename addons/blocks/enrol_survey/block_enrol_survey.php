<?php //$Id$

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This is a one-line short description of the file                    (1)
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.                        (2)
 *
 * @package   block_enrol_survey                                      (3)
 * @copyright Remote-learner
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//require_once($CFG->dirroot.'/lib/weblib.php');
require_once($CFG->dirroot . '/blocks/enrol_survey/lib.php');
require_once($CFG->dirroot . '/blocks/enrol_survey/config_instance.php');

class block_enrol_survey extends block_base {
    /**
     * block initializations
     */
    public function init() {
        $this->title   = get_string('title', 'block_enrol_survey');
        $this->version = '2010060700';
        $this->cron = HOURSECS;
    }

    /**
     * block contents
     *
     * @return object
     */
    public function get_content() {
        global $CFG, $COURSE, $USER;

        if($this->content !== NULL) {
            return $this->content;
        }

        if($COURSE->id == SITEID) {
            $context = get_context_instance(CONTEXT_SYSTEM);
        } else {
            $context = get_context_instance(CONTEXT_COURSE, $COURSE->id);
        }

        $this->content = new stdClass();
        $this->content->text = '';
        $this->content->footer = '';

        if(has_capability('block/enrol_survey:edit', $context)) {
            $editpage = get_string('editpage', 'block_enrol_survey');

            $this->content->text .= "<a href=$CFG->wwwroot/blocks/enrol_survey/edit_survey.php?id={$this->instance->id}>$editpage</a><br />";
        }

        if(has_capability('block/enrol_survey:take', $context)) {
            if(!empty($this->config->force_user) && !is_survey_taken($USER->id, $this->instance->id)) {
                redirect("$CFG->wwwroot/blocks/enrol_survey/survey.php?id={$this->instance->id}");
            }

            $takepage = get_string('takepage', 'block_enrol_survey');
            $this->content->text .= "<a href=$CFG->wwwroot/blocks/enrol_survey/survey.php?id={$this->instance->id}>$takepage</a><br />";
        }

        return $this->content;
    }


    function specialization() {
        if(!empty($this->config->title)){
            $this->title = $this->config->title;
        }else{
            $this->config->title = get_string('title', 'block_enrol_survey');
        }
    }

    /**
     * allow the block to have a configuration page
     *
     * @return boolean
     */
    public function has_config() {
        return false;
    }

    /**
     * allow more than one instance of the block on a page
     *
     * @return boolean
     */
    public function instance_allow_multiple() {
        //allow more than one instance on a page
        return true;
    }

    /**
     * allow instances to have their own configuration
     *
     * @return boolean
     */
    function instance_allow_config() {
        //allow instances to have their own configuration
        return true;
    }

    /**
     * locations where block can be displayed
     *
     * @return array
     */
    public function applicable_formats() {
        return array('all'=>true);
    }

    function instance_config_print() {
        if (!$this->instance_allow_multiple() && !$this->instance_allow_config()) {
            return false;
        }

        global $CFG;

        $form = new enrole_survey_config_form();
        $form->set_data($this);
        $form->set_data($this->config);
        $form->display();

        return true;
    }

    /**
     *  runs the survey at the specified time interval
     * @param bool $manual
     */
    function cron($manual = false) {
        global $CFG;

        $now = time();

        $sql = "SELECT bi.*
                FROM {$CFG->prefix}block AS b
                JOIN {$CFG->prefix}block_instance as bi ON b.id = bi.blockid
                WHERE b.name = 'enrol_survey' ";

        $block_instances = get_records_sql($sql);

        if(!empty($block_instances)) {
            foreach($block_instances as $survey) {
                $block = block_instance('enrol_survey', $survey);

                if(!empty($block->config) && !empty($block->config->cron_time)) {
                    if(!isset($block->config->last_cron)) {
                        $block->config->last_cron = 0;
                    }

                    if($block->config->last_cron + $block->config->cron_time <= $now) {
                        $block->config->last_cron = $now;

                        delete_records('block_enrol_survey_taken', 'blockinstanceid', $survey->id);

                        $block->instance_config_save($block->config);
                    }
                }
            }
        }

        return true;
    }
}
?>
