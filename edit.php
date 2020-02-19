<?php
include('inc/header.php');
include('inc/functions.php');

if (isset($_GET['id'])) {
    list($entry_id, $title, $date, $time_spent, $learned, $resources, $tags) = get_entry(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entry_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
    $time_spent = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
    $learned = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
    $resources = trim(filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));
    $tags = trim(filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_STRING));

    if (empty($title) || empty($date) || empty($time_spent) || empty($learned) ) {
        $error_message = 'Please fill in the required fields: Title, Date, Time Spent, What i Learned';
    } else {
        if (add_entry($title, $date, $time_spent, $learned, $resources, $tags, $entry_id)) {
            header('Location: index.php');
            exit;
        } else {
            $error_message = 'Could not edit project';
        }
    }
}


?>
                <div class="edit-entry">
                <?php
                if (isset($error_message)) {
                        echo "<p class='message'>$error_message</p>";
                    }?>
                    <h2>Edit Entry</h2>
                    <form method="post" action="edit.php">
                        <label for="title"> Title</label>
                        <input id="title" value='<?php echo"$title" ?>' type="text" name="title"><br>
                        <label for="date">Date</label>
                        <input id="date" value='<?php echo"$date" ?>' type="date" name="date"><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" value='<?php echo"$time_spent" ?>'type="text" name="timeSpent"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"><?php echo"$learned" ?></textarea>
                        <label for="resources-to-remember">Resources to Remember (separate by comma)</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"><?php echo"$resources" ?></textarea>
                        <label for="tag">Tags (separate by comma)</label>
                        <input id="tag" type="text" value='<?php echo"$tags" ?>' name="tag"><br>
                        <?php if(!empty($entry_id)) {
                            echo '<input type="hidden" name="id" value="'.$entry_id.'"/>';
                        }?>
                        <input type="submit" value="Publish Entry" class="button">
                        <a href="#" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>
        <footer>
            <div>
                &copy; MyJournal
            </div>
        </footer>
    </body>
</html>