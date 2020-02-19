<?php
include('inc/header.php');
include('inc/functions.php');

// add_column();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
    $time_spent = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
    $learned = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
    $resources = trim(filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));
    $tags = trim(filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_STRING));

    if (empty($title) || empty($date)) {
        $error_message = 'Please fill in the required fields: Title, Category';
    } else {
        if (add_entry($title, $date, $time_spent, $learned, $resources, $tags)) {
            header('Location: index.php');
            exit;
        } else {
            $error_message = 'Could not add project';
        }
    }
}
?>
                <div class="new-entry">
                <?php 
                    if (isset($error_message)) {
                        echo "<p class='message'>$error_message</p>";
                    }?>
                    <h2>New Entry</h2>
                    <form method="post" action="new.php">
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date"><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"></textarea>
                        <label for="resources-to-remember">Resources to Remember (separate by comma)</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"></textarea>
                        <label for="tag">Tags (separate by comma)</label>
                        <input id="tag" type="text" name="tag"><br>
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