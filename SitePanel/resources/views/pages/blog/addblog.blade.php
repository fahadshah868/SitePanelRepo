<div class="form-main-container">
    <div class="form-main-heading">Add Blog</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addcarouselofferform" action="#" method="#">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Title</div>
                        <input type="text" class="form-control form-field-text" placeholder="Title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Body</div>
                        <textarea placeholder="Body"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6" id="category-logo-container">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Image</div>
                        <img src="#" id="imgpath" />
                        <input type="file" class="form-field-file hide" name="categorylogo" id="categorylogo"  accept=".png, .jpg, .jpeg"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Blog" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $('textarea').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.
</script>
