<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div class="comment-form">
            <h2 class='text-center mb-3 fw-bold text-white'>Reviews</h2>
            <form action="" method="POST">
                <input type="hidden" name="form_token" value="">
                <div class="form-floating mb-3">
                    <textarea name="context" class='form-control' name='context' id="context"></textarea>
                    <label for="commentText">Write a comment</label>
                </div>
                <div class="review-control text-center">
                    <button type='submit' class='btn btn-success' name='comment'>Comment</button>
                    <button type='reset' class='btn btn-danger' name='btn-reset'>Cancel</button>
                </div>
            </form>
        </div>
</body>
</html>