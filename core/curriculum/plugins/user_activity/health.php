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

$user_activity_health_checks = array(
    'user_activity_health_empty'
    );

class user_activity_health_empty extends crlm_health_check_base {
    function __construct() {
        global $CURMAN;
        $this->lastrun = isset($CURMAN->config->user_activity_last_run) ? (int)$CURMAN->config->user_activity_last_run : 0;
        $this->inprogress = isset($CURMAN->config->user_activity_state);
    }

    function exists() {
        // health warning if the cron hasn't been run, or hasn't run for the
        // last week
        return !$this->lastrun;
    }

    function title() {
        return 'ETL process has not run yet';
    }

    function severity() {
        if ($this->inprogress) {
            return healthpage::SEVERITY_NOTICE;
        } else {
            return healthpage::SEVERITY_ANNOYANCE;
        }
    }

    function description() {
        if ($this->inprogress) {
            return "The ETL process has not completed running.  Certain reports (such as the site-wide time summary) may show incomplete data until the ETL process has completed.";
        } else {
            return "The ETL process has not been run.  This prevents certain reports (such as the
site-wide time summary) from working.";
        }
    }

    function solution() {
        if ($this->inprogress) {
            return "The ETL process is in progress, and should complete automatically.  It may take some time, depending on the size of the log table.  Please check back in a day or two.  If the problem persists, please contact support.  Support, please escalate to the development team.";
        } else {
            return "If the Moodle cron is run regularly, then the ETL cron should run automatically overnight.  Please check back tomorrow.  If the problem persists, please contact support.  Support, please escalate to the development team.";
        }
    }
}
?>
