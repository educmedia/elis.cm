<?php

$string['enrol_confirmation'] = 'you will be placed on a waiting list for this course. Are you sure  you would like to enroll in ($a->coursename)$a->classid?';
$string['autoenrol'] = 'Auto-Enroll';
$string['curr_admin:overrideclasslimit'] = 'Can over enroll a class';
$string['curr_admin:curriculum:enrol'] = 'Manage curriculum enrollments';
$string['curr_admin:curriculum:enrol_cluster_user'] = 'Manage cluster users\' curriculum enrollments';
$string['curr_admin:track:enrol'] = 'Manage track enrollments';
$string['curr_admin:track:enrol_cluster_user'] = 'Manage cluster users\' track enrollments';
$string['curr_admin:class:enrol'] = 'Manage class enrollments';
$string['curr_admin:class:enrol_cluster_user'] = 'Manage cluster users\' class enrollments';
$string['student_deleteconfirm'] = 'Are you sure you want to unenroll the student name: $a ?<br />'.
                                   'NOTE: This will delete all records for this student in this class and will unenroll them from any connected Moodle class!';
$string['enrol'] = 'Enroll';
$string['unenrol'] = 'Unenroll';
$string['origenroldate'] = 'Original enroll date';
$string['enroldate'] = 'Enroll date';
$string['trackasso_autoenrol'] = 'Auto enroll';
$string['enrol_all_users_now'] = 'Enroll all users from this track now';
$string['autoenrolcrumb'] = 'Autoenroll user in tracks?';
$string['cluster_manual_autoenrol_label'] = 'Autoenroll in tracks';
$string['click_user_enrol_track'] = 'Click on a user to enroll him/her in the track.';
$string['confirm_unenrol_student_track'] = 'Are you sure you want to unenroll \"$a->name\" from track \"$a->track\"?';
$string['delete_student_note'] = 'NOTE: This will delete all records for this student in this class and will unenroll them from any connected Moodle class!';
$string['enrol_selected'] = 'Enroll Selected';
$string['enrolstudents'] = 'Enroll Student';
$string['waitlistenrol'] = 'Auto enroll from waitlist';
$string['over_enrol'] = 'Over Enroll';
$string['error_not_using_elis_enrolment'] = 'The associated Moodle course is not using the ELIS enrollment plugin';
$string['auto_enrol'] = 'Auto-enroll';
$string['auto_enrol_cluster_curriculum'] = 'Auto-enroll users into this curriculum when they are added to this cluster';
$string['auto_enrol_cluster_track'] = 'Auto-enroll users into this track when they are added to this cluster';
$string['auto_enrol_long'] = 'Auto-enroll users into this class when they are added to this track';
$string['auto_enrol_warning'] = 'NOTE: this class is set to auto-enroll users, but is not from a required course in the curriculum.  The auto-enroll function only applies to required courses, so users will not be auto-enrolled in this class.';
$string['no_auto_enrol'] = 'NOTE: The auto-enroll flag cannot be set for this class in this track, because the associated courses is not a required course in the curriculum.';
$string['error_n_overenrol'] = 'The over enroll capability is required for this';
$string['restrict_to_elis_enrolment_plugin'] = 'Only allow enrollments to Moodle courses that use the elis plugin';
$string['moodleenrol_subj'] = 'Ready to enroll in {$a->class->idnumber}.';
$string['moodleenrol'] = 'You have been removed from the waiting list for class {$a->class->idnumber}.
Please visit {$a->wwwroot}/course/enrol.php?id={$a->crs->id} to complete your enrollment.';
$string['confirm_waitlist_overenrol'] = 'Over enroll $a users into the class';

?>