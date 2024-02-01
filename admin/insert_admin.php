<?php
require_once('../config.php');
$admin_username = $_POST['admin_username'];
$admin_email = $_POST['admin_email'];
$admin_password = $_POST['admin_password'];
$insert = "INSERT INTO cake_shop_admin_registrations (admin_username, admin_email, admin_password) values ('$admin_username', '$admin_email', '$admin_password')";
$select = "SELECT * FROM cake_shop_admin_registrations where admin_username = '$admin_username'";
$query = mysqli_query($conn, $select);
$res = mysqli_fetch_assoc($query);
if (mysqli_num_rows($query) > 0) {
	header("Location: admin_signup.php?register_msg=1");
}
else {
	mysqli_query($conn, $insert);
	header("Location: index.php");
}
?>
options as $key => $option) {
        $isCorrect = ($key + 1 == $correctOption) ? 1 : 0;
        $sql = "INSERT INTO options (question_id, option_text, is_correct) VALUES ('$questionId', '$option', '$isCorrect')";
        $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Add your styling here */
    </style>
</head>
<body>
    <div id="sidebar">
        <button onclick="toggleForm('categoryForm')">Add Category</button>
        <button onclick="toggleForm('questionForm')">Add MCQ Questions</button>
    </div>

    <div id="main-content">
        <div id="categoryForm" style="display:none;">
            <form method="post">
                <label for="categoryName">Category Name:</label>
                <input type="text" name="categoryName" required>
                <button type="submit" name="addCategory">Add Category</button>
            </form>
        </div>

        <div id="questionForm" style="display:none;">
            <form method="post">
                <label for="categoryId">Category:</label>
                <select name="categoryId" required>
                    <?php $categories = getAllCategories(); ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <div id="questionsContainer">
                    <div class="question">
                        <label for="questionText">Question:</label>
                        <input type="text" name="questions[0][questionText]" required>

                        <label for="options">Options:</label>
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <input type="text" name="questions[0][options][]" placeholder="Option <?php echo $i; ?>" required>
                        <?php endfor; ?>

                        <label for="correctOption">Correct Option:</label>
                        <select name="questions[0][correctOption]" required>
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <button type="button" onclick="addQuestion()">Add More Questions</button>
                <button type="submit" name="addQuestions">Save All Questions</button>
            </form>
        </div>
    </div>

    <script>
        function toggleForm(formId) {
            var forms = document.querySelectorAll('div[id$="Form"]');
            forms.forEach(function(form) {
                form.style.display = (form.id === formId && form.style.display !== 'block') ? 'block' : 'none';
            });
        }

        function addQuestion() {
            var container = document.getElementById('questionsContainer');
            var questionDiv = document.createElement('div');
            var questionCount = container.children.length;

            questionDiv.className = 'question';
            questionDiv.innerHTML = `
                <label for="questionText">Question:</label>
                <input type="text" name="questions[${questionCount}][questionText]" required>

                <label for="options">Options:</label>
                <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 1" required>
                <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 2" required>
                <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 3" required>
                <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 4" required>

                <label for="correctOption">Correct Option:</label>
                <select name="questions[${questionCount}][correctOption]" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            `;

            container.appendChild(questionDiv);
        }
    </script>
</body>
</html>
