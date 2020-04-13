<?php

use Tumic\Modules\Users\User;
?>
<h1>Uživatelé</h1>


<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Jméno</th>
                <th>Role</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php


            foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user->name ?></td>
                    <td>
                        <form action="<?php p(linkTo("/users/updateRole/" . $user->id)) ?>" method="post" class="roleForm">
                            <?php
                            include_with_vars(
                                BASE_TEMPLATES . "form_controls/_select.html.php",
                                [
                                    "label" => "Role",
                                    "name" => "user[role]",
                                    "options" => User::$roles,
                                    "value" => @$user->role,
                                    "error" => @$user->errors["role"]
                                ]
                            );
                            ?>
                        </form>
                    </td>
                    <td><a href="<?php p(linkTo("/users/destroy/" . $user->id)) ?>" class="btn btn-danger">Odstranit</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $(function() {
        var $roleSelects = $(".roleForm select");

        $roleSelects.change(function() {
            $(this).closest("form").submit();
        });

    });
</script>