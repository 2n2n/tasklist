@if( count($errors)  > 0 )
    <div class="alert alert-danger">
        <strong>Whoops! Something Went Wrong!</strong>
        <br>
        <ul>
            @<?php foreach ($errors->all() as $error): ?>
                <li>{{ $error }}</li>
            <?php endforeach; ?>
        </ul>
    </div>
@endif
