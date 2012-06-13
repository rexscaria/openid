<?php

/* * ******************************************************************** */
/* ATutor							          */
/* * ******************************************************************** */
/* Copyright (c) 2002-2012                                                */
/* Inclusive Design Institute	                                          */
/* http://atutor.ca                                                       */
/*                                      			          */
/* This program is free software. You can redistribute it and/or          */
/* modify it under the terms of the GNU General Public License            */
/* as published by the Free Software Foundation.                          */
/* * ******************************************************************** */
//$Id: openid_util_fns.php UTF-8 10055 Jun 13, 2012 7:08:49 PM Author:scari$


function unset_session(){
    if (isset($_SESSION['member_id'])) {
        $sql = "DELETE FROM ".TABLE_PREFIX."users_online WHERE member_id=$_SESSION[member_id]";
        $result = @mysql_query($sql, $db);
    }
                 unset($_SESSION['login']);
                 unset($_SESSION['valid_user']);
                 unset($_SESSION['member_id']);
                 unset($_SESSION['is_admin']);
                 unset($_SESSION['course_id']);
                 unset($_SESSION['is_super_admin']);
                 unset($_SESSION['dd_question_ids']);

                 $_SESSION['prefs']['PREF_FORM_FOCUS'] = 1;                
} 


function query_openid_settings($setting_term) {
    
}
?>                                                                                               
