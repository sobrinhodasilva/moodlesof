<?php // $Id: play.php,v 1.8 2012/07/25 22:46:42 bdaloukas Exp $

function game_bookquiz_continue( $id, $game, $attempt, $bookquiz, $chapterid, $context)
{	
	if( $attempt != false and $bookquiz != false){
		return game_bookquiz_play( $id, $game, $attempt, $bookquiz, $chapterid, $context);
	}
	
	if( $attempt == false){
		$attempt = game_addattempt( $game);
	}

	$bookquiz = new stdClass();
	$bookquiz->lastchapterid = 0;
	$bookquiz->id = $attempt->id;
	$bookquiz->bookid = $game->bookid;
	
	if( !game_insert_record(  'game_bookquiz', $bookquiz)){
		print_error( 'game_bookquiz_continue: error inserting in game_bookquiz');
	}	
	
	return game_bookquiz_play( $id, $game, $attempt, $bookquiz, 0, $context);
}

function game_bookquiz_play( $id, $game, $attempt, $bookquiz, $chapterid, $context)
{
    global $DB, $OUTPUT, $cm;

	if( $bookquiz->lastchapterid == 0){
		game_bookquiz_play_computelastchapter( $game, $bookquiz);
		
		if( $bookquiz->lastchapterid == 0){
			print_error( get_string( 'bookquiz_empty', 'game'));
		}
	}
	if( $chapterid == 0){
		$chapterid = $bookquiz->lastchapterid;
	}else
	{
		if( ($DB->set_field( 'game_bookquiz', 'lastchapterid', $chapterid, array( 'id' => $bookquiz->id))) == false){
			print_error( "Can't update table game_bookquiz with lastchapterid to $chapterid");
		}
	}
	
	$book = $DB->get_record( 'book', array('id' => $game->bookid));
	if( !$chapter = $DB->get_record( 'book_chapters', array('id' => $chapterid))){
		print_error('Error reading book chapters.');
	}
	$select = "bookid = $game->bookid AND hidden = 0";
	$chapters = $DB->get_records_select('book_chapters', $select, null, 'pagenum', 'id, pagenum, subchapter, title, hidden');
	
	$okchapters = array();
	if( ($recs = $DB->get_records( 'game_bookquiz_chapters', array( 'attemptid' => $attempt->id))) != false){
		foreach( $recs as $rec){
			//1 means correct answer
			$okchapters[ $rec->chapterid] = 1;
		}
	}
	//2 means current
	//$okchapters[ $chapterid] =  2;
	$showquestions = false;
	$a = array( 'gameid' => $game->id, 'chapterid' => $chapterid);
	if( ($questions = $DB->get_records( 'game_bookquiz_questions', $a)) === false){
		if( !array_key_exists( $chapterid, $okchapters)){
			$okchapters[ $chapterid] =  1;
			$newrec = new stdClass();
			$newrec->attemptid = $attempt->id;
			$newrec->chapterid = $chapterid;
		
			if( !$DB->insert_record( 'game_bookquiz_chapters', $newrec)){
				print_error( "Can't insert to table game_bookquiz_chapters");
			}
		}
	}else
	{
		//Have to select random one question
		$questionid = game_bookquiz_selectrandomquestion( $questions);
		if( $questionid != 0){
			$showquestions = true;
		}
	}
	
	
/// prepare chapter navigation icons
$previd = null;
$nextid = null;
$found = 0;
$scoreattempt = 0;
foreach ($chapters as $ch) {
	$scoreattempt++;
    if ($found) {
        $nextid= $ch->id;
        break;
    }
    if ($ch->id == $chapter->id) {
        $found = 1;
    }
    if (!$found) {
        $previd = $ch->id;
    }
}
if ($ch == current($chapters)) {
    $nextid = $ch->id;
}
if( count( $chapters)){
	$scoreattempt = ($scoreattempt-1) / count( $chapters);
}

$chnavigation = '';	


if ($previd) {
	$chnavigation .= '<a title="'.get_string('navprev', 'book').'" href="attempt.php?id='.$id.'&chapterid='.$previd.'"><img src="'.$OUTPUT->pix_url('bookquiz/nav_prev', 'mod_game').'" class="bigicon" alt="'.get_string('navprev', 'book').'"/></a>';
} else {
    $chnavigation .= '<img src="'.$OUTPUT->pix_url('bookquiz/nav_prev_dis', 'mod_game').'" class="bigicon" alt="" />';
}

$nextbutton = '';
if ($nextid) {
	if( !$showquestions){
		$chnavigation .= '<a title="'.get_string('navnext', 'book').'" href="attempt.php?id='.$id.'&chapterid='.$nextid.'"><img src="'.$OUTPUT->pix_url('bookquiz/nav_next', 'mod_game').'" class="bigicon" alt="'.get_string('navnext', 'book').'" ></a>';
		$nextbutton = '<center>';
		$nextbutton  .= '<form name="form" method="get" action="attempt.php">';
		$nextbutton  .= '<input type="hidden" name="id" value="'.$id.'" >'."\r\n";
		$nextbutton  .= '<input type="hidden" name="chapterid" value="'.$nextid.'" >'."\r\n";
		$nextbutton  .= '<input type="submit" value="'.get_string( 'continue').'">';
		$nextbutton  .= '</center>';
		$showquestions = false;
		game_updateattempts_maxgrade( $game, $attempt, $scoreattempt, 0);
	}
} else {
	game_updateattempts_maxgrade( $game, $attempt, 1, 0);
    $sec = '';
    if( !isset( $cm))
        $cm = get_coursemodule_from_id('game', $game->id);
    if ($section = $DB->get_record('course_sections', array( 'id' => $cm->section))) {
        $sec = $section->section;
    }
	
	if (! $cm = $DB->get_record('course_modules', array( 'id' => $id))) {
		print_error("Course Module ID was incorrect id=$id");
	}	
    $chnavigation .= '<a title="'.get_string('navexit', 'book').'" href="../../course/attempt.php?id='.$cm->course.'"><img src="'.$OUTPUT->pix_url('bookquiz/nav_exit', 'mod_game').'" class="bigicon" alt="'.get_string('navexit', 'book').'" /></a>';
}

require( 'toc.php');
$tocwidth = '10%';

	if( $showquestions){
	    if( $game->param3 == 0)
    		game_bookquiz_showquestions( $id, $questionid, $chapter->id, $nextid, $scoreattempt, $game, $context);
	}

	
?>
<table border="0" cellspacing="0" width="100%" valign="top" cellpadding="2">

<!-- subchapter title and upper navigation row //-->
<tr>
    <td width="<?php echo  10;?>" valign="bottom">
    </td>
    <td valign="top">
        <table border="0" cellspacing="0" width="100%" valign="top" cellpadding="0">
        <tr>
            <td align="right"><?php echo $chnavigation ?></td>
        </tr>
        </table>
    </td>
</tr>

<!-- toc and chapter row //-->
<tr>
    <td width="<?php echo $tocwidth ?>" valign="top" align="left">
        <?php
        echo $OUTPUT->box_start('generalbox');
        echo $toc;
        echo $OUTPUT->box_end();
        ?>
    </td>
    <td valign="top" align="left">
        <?php
        echo $OUTPUT->box_start('generalbox');
        $content = '';
        if (!$book->customtitles) {
          if ($currsubtitle == '&nbsp;') {
              $content .= '<p class="book_chapter_title">'.$currtitle.'</p>';
          } else {
              $content .= '<p class="book_chapter_title">'.$currtitle.'<br />'.$currsubtitle.'</p>';
          }
        }
        $content .= $chapter->content;

        $nocleanoption = new object();
        $nocleanoption->noclean = true;
        echo '<div>';
		if( $nextbutton != ''){
			echo $nextbutton;
		}
        echo format_text($content, FORMAT_HTML, $nocleanoption, $id);
		if( $nextbutton != ''){
			echo $nextbutton;
		}
		
        echo '</div>';
        echo $OUTPUT->box_end();
        /// lower navigation
        echo '<p align="right">'.$chnavigation.'</p>';
        ?>
    </td>
</tr>
</table>

<?php
	if( $showquestions){
	    if( $game->param3 != 0)
    		game_bookquiz_showquestions( $id, $questionid, $chapter->id, $nextid, $scoreattempt, $game, $context);
	}
}

function game_bookquiz_play_computelastchapter( $game, &$bookquiz)
{
    global $DB;

	$pagenum = $DB->get_field( 'book_chapters', 'min(pagenum) as p', array('bookid' => $game->bookid));
	if( $pagenum){
		$bookquiz->lastchapterid = $DB->get_field( 'book_chapters', 'id', array('bookid' => $game->bookid, 'pagenum' => $pagenum));
		
		if( $bookquiz->lastchapterid){
			//update the data in table game_bookquiz
			if( ($DB->set_field( 'game_bookquiz', 'lastchapterid', $bookquiz->lastchapterid, array('id' => $bookquiz->id))) == false){
				print_error( "Can't update table game_bookquiz with lastchapterid to $bookquiz->lastchapterid");
			}
		}
	}
}

function game_bookquiz_showquestions( $id, $questionid, $chapterid, $nextchapterid, $scoreattempt, $game, $context)
{
	$onlyshow  = false;
	$showsolution = false;

	$questionlist = $questionid;
    $questions = game_sudoku_getquestions( $questionlist);

	global $CFG;
	
	/// Start the form
    echo "<form id=\"responseform\" method=\"post\" action=\"{$CFG->wwwroot}/mod/game/attempt.php\" onclick=\"this.autocomplete='off'\">\n";
	if( ($onlyshow === false) and ($showsolution  === false)){
		echo "<center><input type=\"submit\" name=\"finishattempt\" value=\"".get_string('sudoku_submit', 'game')."\"></center>\n";
	}

    // Add a hidden field with the quiz id
    echo '<div>';
    echo '<input type="hidden" name="id" value="' . s($id) . "\" />\n";
    echo '<input type="hidden" name="action" value="bookquizcheck" />';
    echo '<input type="hidden" name="chapterid" value="'.$chapterid.'" />';
    echo '<input type="hidden" name="scoreattempt" value="'.$scoreattempt.'" />';
    echo '<input type="hidden" name="nextchapterid" value="'.$nextchapterid.'" />';

	/// Print all the questions

    // Add a hidden field with questionids
    echo '<input type="hidden" name="questionids" value="'.$questionlist."\" />\n";

	$number=0;
    foreach ($questions as $question) {
        game_print_question( $game, $question, $context);
    }
    echo "</div>";

    // Finish the form
    echo '</div>';
	if( ($onlyshow === false) and ($showsolution === false)){
		echo "<center><input type=\"submit\" name=\"finishattempt\" value=\"".get_string('sudoku_submit', 'game')."\"></center>\n";
	}

    echo "</form>\n";
}

function game_bookquiz_selectrandomquestion( $questions)
{
    global $DB;

	$categorylist = '';
	if( $questions == false){
		return 0;
	}
	
	foreach( $questions as $rec){
		$categorylist  .= ',' . $rec->questioncategoryid;
	}
	$select = 'category in ('.substr( $categorylist, 1). ") AND qtype in ('shortanswer', 'truefalse', 'multichoice')";
	if( ($recs = $DB->get_records_select( 'question', $select, null, '', 'id,id')) == false){
		return 0;
	}
	$a = array();
	foreach( $recs as $rec){
		$a[ $rec->id] = $rec->id;
	}

	if( count( $a) == 0){
		return 0;
	}else
	{
		return array_rand( $a);
	}
}

function game_bookquiz_check_questions( $id, $game, $attempt, $bookquiz, $context)
{
    global $USER, $DB;

    $scoreattempt = optional_param('scoreattempt',  0, PARAM_INT);
    $responses = data_submitted();

	$questionlist = $responses->questionids;
	
    $questions = game_sudoku_getquestions( $questionlist);
    $grades = game_grade_questions( $questions);

	$scorequestion = 0;
	$scoreattempt = 0;
	
	$chapterid = required_param('chapterid', PARAM_INT);
	$nextchapterid = required_param('nextchapterid', PARAM_INT);

    foreach($questions as $question) {
        if( !array_key_exists( $question->id, $grades)){
            //no answered
            continue;
        }
        $grade = $grades[ $question->id];
        if( $grade->grade < 0.5){
            continue;
        }

        //found one correct answer
		if( !$DB->get_field( 'game_bookquiz_chapters', 'id', array( 'attemptid' => $attempt->id, 'chapterid' => $chapterid)))
		{
			$newrec = new stdClass();
			$newrec->attemptid = $attempt->id;
			$newrec->chapterid = $chapterid;
			if( !$DB->insert_record( 'game_bookquiz_chapters', $newrec, false)){
				print_object( $newrec);
				print_error( "Can't insert to table game_bookquiz_chapters");
			}
		}
		//Have to go to next page.
		$bookquiz->lastchapterid = $nextchapterid;
		$scorequestion = 1;
		break;
    }
	
	$query = new stdClass();
	$query->id = 0;
	$query->attemptid = $attempt->id;
	$query->gameid = $game->id;
	$query->userid = $USER->id;
	$query->sourcemodule = 'question';
	$query->questionid = $question->id;
	$query->glossaryentryid = 0;
	$query->questiontext = $question->questiontext;
	$query->timelastattempt = time();
	game_update_queries( $game, $attempt, $query, $scorequestion, '');
	
	game_updateattempts( $game, $attempt, $scoreattempt, 0);

	game_bookquiz_continue( $id, $game, $attempt, $bookquiz, $bookquiz->lastchapterid, $context);
}
